<?php
 namespace PHPReview\AdminBundle\Command;

 use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
 use Symfony\Component\Console\Input\InputArgument;
 use Symfony\Component\Console\Input\InputInterface;
 use Symfony\Component\Console\Output\OutputInterface;
 use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand as DoctrineCommand;

 class ExpiraChaveCommand extends ContainerAwareCommand
 {
     public function configure(){
        $this->setName('phpreview:admin:expira')
             ->setDescription('Comando para desabilitar chaves nao usadas.');
     }
     
     protected function execute(InputInterface $input, OutputInterface $output){
         $output->writeln(date('[d/m/Y H:i:s] ').'Iniciando a verificacao de chaves expiradas ');
         
         $em = $this->getContainer()->get('doctrine')->getEntityManager();
         $qb = $em->createQueryBuilder();
         
         $qb->select('c');
         $qb->from('AdminBundle:Chave','c');
         $qb->where('c.data_expira < :data_expira and c.in_usado = 0 and c.in_expirado = 0');
         $qb->setParameter('data_expira',date('Y-m-d H:i:s'));
         
         $chaves = $qb->getQuery()->getResult();
         
         $output->writeln(date('[d/m/Y H:i:s] ').'Total de chaves encontradas: '. count($chaves));

         for($i = 0; $i < count($chaves);$i++){
            $chaves[$i]->setInExpirado(true);
         }
         
         $em->flush();
         
         $output->writeln(date('[d/m/Y H:i:s] ').'Fim da verificacao de chaves expiradas');
         $output->writeln('-----------/>');
     }
 }
?>
