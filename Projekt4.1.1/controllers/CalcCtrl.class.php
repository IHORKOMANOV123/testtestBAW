<?php
class CalcCtrl {
    private $form;
    private $result;
    private $msgs;

    public function __construct() {
        require_once __DIR__ . '/../models/CalcForm.class.php';
        require_once __DIR__ . '/../models/CalcResult.class.php';
        require_once __DIR__ . '/../models/Messages.class.php';

        $this->form = new CalcForm();
        $this->msgs = new Messages();
        $this->result = new CalcResult();
    }

    public function getParams() {
        $this->form->loadFromRequest();
    }

    public function validate() {
        if ($this->form->kwota === null || $this->form->kwota === "") {
            $this->msgs->add("Nie podano kwoty kredytu.");
        }
        if ($this->form->lat === null || $this->form->lat === "") {
            $this->msgs->add("Nie podano liczby lat.");
        }
        if ($this->form->procent === null || $this->form->procent === "") {
            $this->msgs->add("Nie podano oprocentowania.");
        }

        return $this->msgs->isEmpty();
    }

    public function process() {
        if ($this->validate()) {
            $n = $this->form->lat * 12;
            $r = $this->form->procent / 100;
            $kwota_do_splaty = $this->form->kwota + ($this->form->kwota * $r * $this->form->lat);
            $rata = $kwota_do_splaty / $n;
            $this->result->monthlyPayment = round($rata, 2);
        }
    }

    public function display() {
        require_once __DIR__ . '/../lib/smarty/smarty.class.php';

        $smarty = new Smarty();
        $smarty->template_dir = __DIR__ . '/../templates/';
        $smarty->compile_dir  = __DIR__ . '/../templates_c/';
        $smarty->cache_dir    = __DIR__ . '/../cache/';
        $smarty->config_dir   = __DIR__ . '/../configs/';

        $smarty->assign('form', $this->form);
        $smarty->assign('result', $this->result);
        $smarty->assign('messages', $this->msgs->getMessages());

        $smarty->display('calc.tpl');
    }
}
?>
