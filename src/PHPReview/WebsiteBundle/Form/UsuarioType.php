<?php

namespace PHPReview\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class UsuarioType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options){
        $builder->add('id_usuario', 'hidden');
        $builder->add('ds_nome','text',array('label'=>'Nome:'));
        $builder->add('sexo','choice',array('label'    => 'Sexo:',
                                             'choices' => array('M'=>'Masculino','F'=>'Feminino'),
                                             'required'=> true,
                                             'multiple'=> false,
                                             'expanded'=> true));
        $builder->add('ds_email','text',array('label'=>'Nome para apresentacao:'));
        $builder->add('ds_senha',        'email',array('label'=>'E-mail:'));
        $builder->add('ds_confirma_senha',        'password',array('label'=>'Senha:'));
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
              'multiply'=>false,
              'expanded'=>false,
              'required'=>true,
              ''));
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
              'multiply'=>false,
              'expanded'=>false,
              'required'=>true,
              ''));
        $builder->add('cargo','entity',array(
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
              'multiply'=>false,
              'expanded'=>false,
              'required'=>true,
              ''));
        $builder->add('captcha','captcha');
        $builder->add();
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
