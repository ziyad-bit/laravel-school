<?php

namespace App\Http\Controllers\users;


use App\Model\{Degrees,Paypals};
use PayPal\Api\{Payment,PaymentExecution};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


//https://developer.paypal.com/docs/api/quickstart/payments/?mark=approval_url

class PaypalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['grievance','auth']);
    }

    ####################################      show      ###################################
    public function show(int $id)
    {
        return view('users.paypal.show',compact('id'));
    }

    ####################################      index      ###################################
    public function index(int $id)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUenS_pY6i5vz25H58plAOK9lBAc1WzPL2g6K1BKZ3hy91cMB8z_XohctESGYxkCUOKHZnogFARMF7iw', // ClientID
                'EDs_PikL_y4lnWSdOQy5C1KDUuUsYJUXLSq1vX7CcxByhCvcJMJ1zjjjBs6CI9xyvKVK0wToByPLCO3l' // ClientSecret
            )
        );

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('20.00');
        $amount->setCurrency('EUR');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(url('paypal/get/'.$id))
            ->setCancelUrl(url('subjects/get'));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            return redirect($payment->getApprovalLink());
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    ####################################       paypalReturn      ###################################
    public function paypalReturn (int $id) {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUenS_pY6i5vz25H58plAOK9lBAc1WzPL2g6K1BKZ3hy91cMB8z_XohctESGYxkCUOKHZnogFARMF7iw', // ClientID
                'EDs_PikL_y4lnWSdOQy5C1KDUuUsYJUXLSq1vX7CcxByhCvcJMJ1zjjjBs6CI9xyvKVK0wToByPLCO3l' // ClientSecret
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            // Execute payment
            $result = $payment->execute($execution, $apiContext);
            if ($result->state == 'approved') {
                $degree=Degrees::find($id);
                $degree->grievance=1;
                $degree->save();

                Paypals::create([
                    'payment_id'=>$result->id,
                    'user_id'=>Auth::user()->id,
                    'degree_id'=>$id,
                ]);
                return redirect('subjects/get')->with(['success'=>'you completed successfully this process']);
            }else{
                return redirect('paypal/show/'.$id)->with(['error'=>'something went wrong']);
            }
            
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } 
    }

}
