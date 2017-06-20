<?php

namespace Bluora\Slack;

use InvalidArgumentException;

class AttachmentAction
{
    const TYPE_BUTTON = 'button';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    /**
     * The required name field of the action. The name will be returned to your Action URL.
     *
     * @var string
     */
    protected $name;

    /**
     * The required label for the action.
     *
     * @var string
     */
    protected $text;

    /**
     * Button style.
     *
     * @var string
     */
    protected $style;

    /**
     * The required type of the action.
     *
     * @var string
     */
    protected $type = self::TYPE_BUTTON;

    /**
     * Optional value. It will be sent to your Action URL.
     *
     * @var string
     */
    protected $value;

    /**
     * Confirmation field.
     *
     * @var ActionConfirmation
     */
    protected $confirm;

    /**
     * Instantiate a new AttachmentAction.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['name'])) {
            $this->setName($attributes['name']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['style'])) {
            $this->setStyle($attributes['style']);
        }

        if (isset($attributes['type'])) {
            $this->setType($attributes['type']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['confirm'])) {
            $this->setConfirm($attributes['confirm']);
        }
    }

    /**
     * Set or get the optional name appear within the attachment.
     *
     * @return mixed
     */
    public function name($name = false)
    {
        if ($name === false) {
            return $this->getName();
        }

        return $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AttachmentAction
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set or get the optional text to appear within the attachment.
     *
     * @return mixed
     */
    public function text($text = false)
    {
        if ($text === false) {
            return $this->getText();
        }

        return $this->setText($text);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return AttachmentAction
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set or get the optional style for the attachment.
     *
     * @return mixed
     */
    public function style($style = false)
    {
        if ($style === false) {
            return $this->getStyle();
        }

        return $this->setStyle($style);
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $style
     * @return AttachmentAction
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Set type to button.
     *
     * @return mixed
     */
    public function button($title)
    {
        return $this->setText($title)
            ->setType('button');
    }

    /**
     * Set or get the optional type for the attachment.
     *
     * @return mixed
     */
    public function type($type = false)
    {
        if ($type === false) {
            return $this->getType();
        }

        return $this->setType($type);
    }

    /**
     * Get the optional type for the attachment.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the optional type for the attachment.
     * 
     * @param string $type
     *
     * @return AttachmentAction
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set or get the optional value for the attachment.
     *
     * @return mixed
     */
    public function value($value = false)
    {
        if ($value === false) {
            return $this->getValue();
        }

        return $this->setValue($value);
    }

    /**
     * Get the optional value for the attachment.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the optional value for the attachment.
     *
     * @param string $value
     *
     * @return AttachmentAction
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set or get the optional confirm for the attachment.
     *
     * @return mixed
     */
    public function confirm($value = false)
    {
        if ($confirm === false) {
            return $this->getConfirm();
        }

        return $this->setConfirm($confirm);
    }

    /**
     * @return ActionConfirmation
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param ActionConfirmation|array $confirm
     * @return AttachmentAction
     */
    public function setConfirm($confirm)
    {
        if ($confirm instanceof ActionConfirmation) {
            $this->confirm = $confirm;

            return $this;
        } elseif (is_array($confirm)) {
            $this->confirm = new ActionConfirmation($confirm);

            return $this;
        }

        throw new InvalidArgumentException('The action confirmation must be an instance of Bluora\Slack\ActionConfirmation or a keyed array');
    }

    /**
     * Get the array representation of this attachment action.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'text' => $this->getText(),
            'style' => $this->getStyle(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'confirm' => !is_null($this->getConfirm()) ? $this->getConfirm()->toArray() : null,
        ];
    }
}
