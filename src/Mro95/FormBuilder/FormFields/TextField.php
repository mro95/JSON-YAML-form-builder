<?php namespace Mro95\FormBuilder\FormFields;

use Mro95\FormBuilder\View\GenericView;

class TextField implements FieldInterface
{
    /**
     * @var string
     */
    private $id = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $class = '';

    /**
     * @var string
     */
    private $placeholder = '';

    /**
     * @var string
     */
    private $value = '';

    /**
     * @var boolean
     */
    private $required = false;

    /**
     * @var boolean
     */
    private $disabled = false;

    /**
     * @var array
     */
    private $validation = [];

    /**
     * @var boolean
     */
    private $wrapper = true;

    /**
     * TextField constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     *
     * @return $this
     */
    public function setClass(string $class)
    {
        $this->class = $class;

        return $this
    }

    /**
     * @return string
     */
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     *
     * @return $this
     */
    public function setPlaceholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     *
     * @return $this
     */
    public function setRequired(bool $required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     *
     * @return $this;
     */
    public function setDisabled(bool $disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return array
     */
    public function getValidation(): array
    {
        return $this->validation;
    }

    /**
     * @param array $validation
     *
     * @return $this
     */
    public function setValidation(array $validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWrapper(): bool
    {
        return $this->wrapper;
    }

    /**
     * @param bool $wrapper
     *
     * @return $this
     */
    public function setWrapper(bool $wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get the properties for the field.
     *
     * @return array
     */
    public function getProperties(): array
    {
        $properties = [];

        //ID
        if ($this->id !== '') {
            $properties[] = "id='{$this->getId()}'";
        }

        // Name
        $properties[] = "name='{$this->getName()}'";

        // Class
        if ($this->class !== '') {
            $properties[] = "class='{$this->getClass()}'";
        }

        // Placeholder
        if ($this->placeholder !== '') {
            $properties[] = "placeholder='{$this->getPlaceholder()}'";
        }

        // Value
        if ($this->value !== '') {
            $properties[] = "value='{$this->getValue()}'";
        }

        // Required
        if ($this->isRequired() === true) {
            $properties[] = 'required';
        }

        // Disabled
        if ($this->isDisabled() === true) {
            $properties[] = 'disabled';
        }

        return $properties;
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        $properties = implode(' ', $this->getProperties());

        $fieldsHtml = GenericView::create('resources/FormFieldTemplates/textfield.php', compact('properties'))->render();
        if ($this->isWrapper()) {
            $view = GenericView::create(
                'resources/FormFieldTemplates/fieldgroup.php',
                ['fields' => $fieldsHtml]
            )->render();
        } else {
            $view = $fieldsHtml;
        }

        return $view;
    }
}
