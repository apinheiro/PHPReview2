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
         $output->writeln('Iniciando a verificacao de chaves expiradas '. date('Y-m-d H:i:s'));
         
         $em = $this->getContainer()->get('doctrine')->getEntityManager();
         $qb = $em->createQueryBuilder();
         
         $qb->select('c');
         $qb->from('AdminBundle:Chave','c');
         $qb->where('c.data_expira < :data_expira and c.in_usado = 0 and c.in_expirado = 0');
         $qb->setParameter('data_expira',date('Y-m-d H:i:s'));
         
         $chaves = $qb->getQuery()->getResult();
         
         $output->writeln('Total de chaves encontradas: '. count($chaves));

         for($i = 0; $i < count($chaves);$i++){
            $chaves[$i]->setInExpirado(true);
         }
         
         $em->flush();
         
         $output->writeln('Fim da verificacao de chaves expiradas');
     }
 }
?>
