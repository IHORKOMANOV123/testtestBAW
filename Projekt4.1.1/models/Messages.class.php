<?php
class Messages {
    private $messages = [];

    public function add($msg) {
        $this->messages[] = $msg;
    }

    public function getMessages() {
        return $this->messages;
    }

    public function isEmpty() {
        return empty($this->messages);
    }
}
?>
