<?php
namespace App\Core\Database\Mapper;


final class DataObject
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * DataObject constructor.
     * @param array $data
     */
    public function __construct(
        array $data
    )
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->data;
    }

    /**
     * @return object
     */
    public function getObject(): object
    {
        return (object) $this->data;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->data);
    }
}