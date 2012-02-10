<?php 

class TestCommand extends CConsoleCommand {

  const N = 1000;
  
  public function actionAddData() {
    $start_time = microtime(true);

    $period = floor(self::N/100);
    for ($i=0; $i<self::N; $i++) {
      if ($i%$period==0)
        echo "Contractor $i\n";
      $contractor = new Contractor; 
      $contractor->name = self::w();
      $contractor->surname = self::w();
      $contractor->save();
    }

    for ($i=0; $i<self::N; $i++) {
      if ($i%$period==0)
        echo "Order $i\n";
      $order = new Order; 
      $order->name = self::phrase();
      $order->contractor_id = rand(1, self::N);
      $order->save();
    }

    $end_time = microtime(true);
    $elapsed_time = $end_time-$start_time;
    echo __FUNCTION__ . ": " . round($elapsed_time, 4) . " secs\n";
  }

  public function actionTest1() {
    $start_time = microtime(true);
    echo "=============================\n";

    $orders = Order::model()->with('contractor')->findAll('contractor.name LIKE "%bbc%"');

    foreach ($orders as $o)
      echo $o->name . "\n";

    echo "=============================\n";
    echo "Count: " . count($orders) . "\n";

    $end_time = microtime(true);
    $elapsed_time = $end_time-$start_time;
    echo __FUNCTION__ . ": " . round($elapsed_time, 4) . " secs\n";
  }

  public function actionTest2() {
    $start_time = microtime(true);
    echo "=============================\n";

    $contractor = Contractor::model()->with('orders')->findAll(array('condition' => 'orders.name LIKE "%zzl%"', 'order' => 't.name DESC'));

    foreach ($contractor as $c)
      echo $c->name . "\n";

    echo "=============================\n";
    echo "Count: " . count($contractor) . "\n";

    $end_time = microtime(true);
    $elapsed_time = $end_time-$start_time;
    echo __FUNCTION__ . ": " . round($elapsed_time, 4) . " secs\n";
  }

  public function actionTest3() {
    $start_time = microtime(true);
    echo "=============================\n";

    $period = floor(self::N/10);
    for ($i=0; $i<self::N; $i++) {
      $c = self::B().self::a().self::a();
      $contractor = Contractor::model()->find("name like '" . $c . "%'");
      if ($i % $period == 0)
        echo $c . ": " . ((isset($contractor))?$contractor->name:'') . "\n";
    }

    echo "=============================\n";

    $end_time = microtime(true);
    $elapsed_time = $end_time-$start_time;
    echo __FUNCTION__ . ": " . round($elapsed_time, 4) . " secs\n";
  }

  public function actionTemplate() {
    $start_time = microtime(true);

    $end_time = microtime(true);
    $elapsed_time = $end_time-$start_time;
    echo __FUNCTION__ . ": " . round($elapsed_time, 4) . " secs\n";
  }

  protected function a() {return chr(rand(97, 122));}
  protected function B() {return chr(rand(65, 90));}
  protected function word() {
    $word = self::a();
    for ($i=0; $i<rand(2, 10); $i++)
      $word .= self::a();
    return $word;
  }
  protected function w() {
    $word = self::B();
    for ($i=0; $i<rand(2, 10); $i++)
      $word .= self::a();
    return $word;
  }
  /*protected function WORD() {
    $word = self::B();
    for ($i=0; $i<rand(2, 10); $i++)
      $word .= self::B();
    return $word;
  }*/
  protected function phrase() {
    $phrase = self::w();
    for ($i=0; $i<rand(0, 5); $i++)
      $phrase .= ' '.self::word();
    return $phrase;
  }
}
