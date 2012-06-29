<?php
namespace PHPReview\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;


class LoginType extends AbstractType
{
    public function getName(){
        return 'login';
    }
    
    public function buildForm(FormBuilder $builder, array $options){
        $builder->add('_username','text',array('label'=>'E-mail:'));
        $builder->add('_password','password',array('label'=>'Senha:'));
    }
    
}
?>
