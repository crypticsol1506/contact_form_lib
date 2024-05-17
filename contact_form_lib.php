<?php

interface Renderable {
    public function render(): string;
}

class Form implements Renderable {
    protected $elements = [];

    public function addElement(Renderable $element) {
        $this->elements[] = $element;
    }

    public function render(): string {
        $output = '<form method="post">';
        foreach ($this->elements as $element) {
            $output .= $element->render();
        }
        $output .= '<input type="submit" value="Submit">';
        $output .= '</form>';
        return $output;
    }
}

class TextElement implements Renderable {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function render(): string {
        return '<input type="text" name="' . $this->name . '">';
    }
}

class InputElement implements Renderable {
    protected $name;
    protected $value;

    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): string {
        return '<input type="hidden" name="' . $this->name . '" value="' . $this->value . '">';
    }
}

// Example usage:
$form = new Form();
$form->addElement(new TextElement('name'));
$form->addElement(new TextElement('email'));
$form->addElement(new InputElement('subject', 'Contact Form Submission'));
$form->addElement(new InputElement('recipient', 'recipient@example.com'));

echo $form->render();

?>
