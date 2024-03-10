<?php

class DequeElement {
    private ?DequeElement $prevElement;
    private int $value;

    public function __construct(int $value, ?DequeElement $prevElement) {
        $this->setValue($value);
        $this->setPrevElement($prevElement);
    }

    public function setPrevElement(?DequeElement $prevElement) {
        $this->prevElement = $prevElement;
    }

    public function getPrevElement(): ?DequeElement {
        return $this->prevElement;
    }

    public function setValue(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }
}

class Dequeu {
    private int $capacity;
    private int $size;

    private DequeElement $headElement;
    private DequeElement $tailElement;

    public function __construct(int $capacity){
        $this->size = 0;
        $this->capacity = $capacity;

        $this->headElement = new DequeElement(0, null);
        $this->tailElement = new DequeElement(0, $this->headElement);
        $this->headElement->setPrevElement($this->tailElement);
    }

    public function pushBack(int $value) {
        return $this->appendNewElement($value, $this->tailElement);
    }

    public function pushFront(int $value) {
        return $this->appendNewElement($value, $this->headElement);
    }

    public function popBack(): int|false {
        return $this->popElement($this->tailElement);
    }

    public function popFront() {
        return $this->popElement($this->headElement);
    }

    private function appendNewElement(int $value, DequeElement &$element): bool {
        if ($this->size == $this->capacity) {
            return false;
        }

        $element->setValue($value);
        $newElement = new DequeElement(0, $element);
        $element = $newElement;
        $this->size++;

        return true;
    }

    private function popElement(DequeElement &$element): int|false {
        if ($this->size == 0) {
            return false;
        }

        $element = $element->getPrevElement();
        $this->size--;
        return $element->getValue();
    }
}

function main() {
    $deque = new Dequeu(3);
    $deque->pushBack(3);
    $deque->pushBack(4);
    $deque->pushFront(5);

    echo $deque->popBack() . "\n";
    echo $deque->popBack() . "\n";
    echo $deque->popFront() . "\n";
}

main();