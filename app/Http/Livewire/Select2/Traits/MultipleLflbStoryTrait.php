<?php

namespace App\Http\Livewire\Select2\Traits;

/**
 * Trait for Multiple / Parent Component Select2
 *
 * @package Blockpc\Select2Wire
 */
trait MultipleLflbStoryTrait
{
    public $lflbStories = [];

	public function initializeMultipleLflbStoryTrait()
	{
		$this->listeners = array_merge($this->listeners, [
			'set-lflbStory' => 'set_lflbStory',
			'remove-lflbStory' => 'remove_lflbStory'
		]);
	}

    public function set_lflbStory(int $id)
    {
        $this->lflbStories[] = $id;
    }

    public function remove_lflbStory(int $id)
    {
        $this->lflbStories = array_diff($this->lflbStories, [$id]);
    }

    public function clean_lflbStories()
    {
        $this->lflbStories = [];
    }
}