<?php
use App\Libraries\FrontendController;
use Qdesign\Services\ContactEmail\ContactEmailInterface;
use Qdesign\Services\Form\Contact\ContactForm;
class FormController extends FrontendController {

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
        parent::__construct();
        $this->email = $email;
        $this->contactForm = $contactForm;
    }

    public function postSubmit()
    {
        $data = Input::all();
        if(!$this->contactForm->validate($data))
            return Redirect::back()->withInput()->withErrors($this->contactForm->errors());
        $data['toEmail'] =$this->data['siteconfig']->company_receive_email;
        $data['toEmailName'] ='Maypro';
        $data['subject'] ='Customer contact from Maypro';
        $message = $this->email->sendEmail($data);
        return Redirect::back()->with('message',$message);
    }
}