<?php

class Usuario{
  public $id;
  public $nome;
  public $email;
  public $senha;
}

class Bolao{
  public $id;
  public $usuario_id;//id gerenciador do bolão
  public $titulo;
  public $rodadaAtual = 0;
  public $pontosResultado = 10;//pontuação do resultado
  public $pontosExtras = 5;//pontos extras(pra se além de acertar o campeão, acertar o placar )
  public $pontosTaxa= 5;//taxa que aumenta os pontos de cima
}

class Rodada{
  public $id;
  public $bolao_id;
  public $titulo;
  public $dataIni;
  public $dataFim;

}

class Partida{
  public $id;
  public $rodada_id;
  public $titulo;
  public $estadio;
  public $timeA;
  public $timeB;
  public $resultado;//(A,B,E) E = Empate
  public $placarTimeA;
  public $placarTimeB;
  public $data;

}
//relaciona usuario que podem apostar no bolão
class BolaoUsuario{
  public $bolao_id;
  public $usuario_id;
  public $pontos;//pontuação do usuario no bolão
}

//relaciona o usuario com a partida
class PartidaUsuario//padão laravel ordem alfabetica 1º letra
{
  public $partida_id;
  public $usuario_id;
  public $resultado; //(A,B,E) E = Empate
  public $placarTimeA;
  public $placarTimeB;
}

// -------------------------  testes: ---------------------//

//gerenciador
  $admin = new Usuario;
  $admin->id=1;
  $admin->nome= "Admin";
  $admin->email= "admin@mail.com";
  $admin->senha="123456";

//apostador
  $apostador = new Usuario;
  $apostador->id=1;
  $apostador->nome= "Apostador";
  $apostador->email= "apostador@mail.com";
  $apostador->senha="123456";

  // cadastro do bolão
$bolao = new Bolao;
  $bolao->id = 1;
  $bolao->usuario_id = $admin->id;//id gerenciador do bolão
  $bolao->titulo = "Bolao do campeonato brasileiro";
  $bolao->rodadaAtual = 0;
  $bolao->pontosResultado = 10;//pontuação do resultado
  $bolao->pontosExtras = 5;//pontos extras(pra se além de acertar o campeão, acertar o placar )
  $bolao->pontosTaxa = 5;//taxa que aumenta os pontos de cima

//rodada
$rodada = new Rodada;

  $rodada->id = 1;
  $rodada->bolao_id = $bolao->id;
  $rodada->titulo = "primeira rodada";
  $rodada->dataIni = "2018-07-8";
  $rodada->dataFim = "2018-07-10";

//partida
  $partida1 = new Partida;

  $partida1->id = 1;
  $partida1->rodada_id = $rodada->id;
  $partida1->titulo = "Inter X Gremio";
  $partida1->estadio = "Beira Rio";
  $partida1->timeA = "Inter";
  $partida1->timeB = "Gremio";
//  $partida1->resultado = ;//(A,B,E) E = Empate
//  $partida1->placarTimeA = ;
//  $partida1->placarTimeB = ;
  $partida1->data = "2018-07-11";//dia do jogo


//----------------Apostador no bolão ---------------------//

$bolaoUsuario = new BolaoUsuario;

$bolaoUsuario->bolao_id =  $bolao->id;
$bolaoUsuario->usuario_id = $apostador->id;
$bolaoUsuario->pontos = 0 ;//pontuação do usuario no bolão

//aposta do usuario
$partida1Apostador = new PartidaUsuario;

$partida1Apostador->partida_id = $partida1->id;
$partida1Apostador->usuario_id = $apostador->id;
$partida1Apostador->resultado = "A"; //(A,B,E) E = Empate
$partida1Apostador->placarTimeA = 2;
$partida1Apostador->placarTimeB = 1;


//finalização da rodadaAtual

   $bolao->rodadaAtual++;
   $partida1->resultado = "A";//(A,B,E) E = Empate
   $partida1->placarTimeA = 2;
   $partida1->placarTimeB = 1;

//---------------------logica de calculos de pontos

//verifica se o apostador acertou
if($partida1Apostador->resultado == $partida1->resultado)
{
  $bolaoUsuario->pontos += $bolao->pontosResultado;

  if($partida1Apostador->placarTimeA ==  $partida1->placarTimeA
  && $partida1Apostador->placarTimeB == $partida1->placarTimeB)
  {
    $bolaoUsuario->pontos += $bolao->pontosExtras;
  }

}

//------------ logica incrementar valores bolão

$bolao->pontosResultado += $bolao->pontosTaxa;
$bolao->pontosExtras += $bolao->pontosTaxa;

echo "Pontos do Apostador:".$bolaoUsuario->pontos;

 ?>
