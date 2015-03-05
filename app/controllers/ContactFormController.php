<?php
use App\Libraries\BaseController;
use Qdesign\Services\ContactEmail\ContactEmailInterface;
use Qdesign\Services\Form\Contact\ContactForm;
class ContactFormController extends BaseController {

    /**
     * @var PageInterface
     */
    private $page;
    /**
     * @var EmailInterface
     */
    private $email;
    /**
     * @var Qdesign\Services\Form\Contact\ContactForm
     */
    private $contactForm;

    public function __construct(ContactForm $contactForm,ContactEmailInterface $email){
        $this->email = $email;
        $this->contactForm = $contactForm;
    }

    public function sendContactMessage()
    {
        $data = Input::all();
        $data['toEmail'] ='vuongtrannguyenkhoi@gmail.com';
        $data['toEmailName'] ='Diem ha';
        $data['subject'] ='Thông tin liên hệ từ khách hàng Diemha.vn';
        if(Request::ajax()){
            if(!$this->contactForm->validate($data))
                echo json_encode($this->contactForm->errors());
            $this->email->sendEmail($data);
            $data['status'] = 1;
            $data['message'] = 'Your message had been sent';
            echo json_encode($data);
        }else{
            if(!$this->contactForm->validate($data))
                return Redirect::back()->withInput()->withErrors($this->contactForm->errors());
            $message = $this->email->sendEmail($data);
            return Redirect::back()->with('message',$message);
        }
    }
}