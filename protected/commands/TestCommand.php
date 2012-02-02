<?php 

class TestCommand extends CConsoleCommand {
  public function actionIndex() {
    for ($i=0; $i<1000; $i++) {
      $order = new Order; 
      $order->name = chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
      $order->save();
    }
  }
}
