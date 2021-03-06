<?php

namespace PHPReview\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;


class UsuarioType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options){
        $builder->add('id', 'hidden');
        $builder->add('nm_usuario','text',array('label'=>'Nome:'));
        $builder->add('sexo','choice',array('label'    => 'Sexo:',
                                             'choices' => array('M'=>'Masculino','F'=>'Feminino'),
                                             'required'=> true,
                                             'multiple'=> false,
                                             'expanded'=> true));
        $builder->add('ds_email','email',array('label'=>'E-mail:'));
        $builder->add('ds_senha','password',array('label'=>'Senha:'));
        $builder->add('ds_confirma_senha','password',array('label'=>'Confirmar Senha:'));
        $builder->add('estado','entity',array(
              'label'=>'Estado:',
              'empty_value'=>'- Selecione',
              'class'=>'AdminBundle:Estados',
              'property'=>'ds_estado',
              'query_builder' => function(EntityRepository $er)
                       { 
                       return $er->createQueryBuilder('e')->
                              where('e.in_disponivel = 1')->
                              orderBy('e.ds_estado','ASC'); 
                       },
              'multiple'=>false,
              'expanded'=>false,
              'required'=>true));
        $builder->add('cargo','entity',array(
              'label'=>'Cargo:',
              'empty_value'=>'- Selecione',
              'class'=>'WebsiteBundle:Cargos',
              'property'=>'ds_cargo',
              'query_builder' => function(EntityRepository $er)
                       { 
                       return $er->createQueryBuilder('c')->
                              where('c.in_disponivel = 1')->
                              orderBy('c.ds_cargo','ASC'); 
                       },
              'multiple'=>false,
              'expanded'=>false,
              'required'=>false));
        $builder->add('como_conheceu','entity',array(
              'label'=>'Como conheceu a revista?',
              'empty_value'=>'- Selecione',
              'class'=>'WebsiteBundle:ComoConheceu',
              'property'=>'ds_como_conheceu',
              'query_builder' => function(EntityRepository $er)
                       { 
                       return $er->createQueryBuilder('c')->
                              where('c.in_ativo = 1')->
                              orderBy('c.ds_como_conheceu','ASC'); 
                       },
              'multiple'=>false,
              'expanded'=>false,
              'required'=>false));
        $builder->add('captcha','captcha');
   }

  public function getName(){
     return 'cadastro_usuario';
  }   
  
  public function getDefaultOption(){
      return array(
            'data_class'      => 'PHPReview\WebsiteBundle\Entity\Usuario',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'usuario',
        );
  }
}
?>
