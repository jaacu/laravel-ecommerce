<?php
namespace App\Helpers;

trait ModelHelper {

    /**
     * Get this model created at timestamp human readable
     * @return string
     */
    public function getCreatedForHumans() : string{
        return $this->created_at->diffForHumans(now());
    }

    /**
     * Get this model updated at timestamp human readable
     * @return string
     */
    public function getUpdatedForHumans() : string{
        return $this->updated_at->diffForHumans(now());
    }

}