<?php

declare(strict_types=1);

namespace App\Http\Livewire\Select2;

use Livewire\Component;
use App\Models\LflbStory;

/**
 * Multiple Select2 Component with parent model
 *
 * @package Blockpc\Select2Wire
 */
class LflbStorySelect2 extends Component
{
    public $lflbStories;
    public $search;

    protected $listeners = [
        'set-lflbStories' => 'set_lflbStories',
        'clear'
    ];

    public function mount()
    {
        $this->lflbStories = collect([]);
    }

    public function getOptionsProperty()
    {
        return LflbStory::where('name', 'LIKE', "%{$this->search}%")->get();
    }

    public function render()
    {
        return view('livewire.select2.lflbStory-select2', [
            'options' => $this->options,
        ]);
    }

    public function save()
    {
        $temporal = $this->parse_search();
        foreach( $temporal as $key => $name ) {
            $lflbStory = LflbStory::firstOrCreate(['name' => $name]);
            if ( ! $this->lflbStories->contains('id', $lflbStory->id) ) {
                $this->lflbStories->push($lflbStory->only(['id', 'name']));
                $this->emitTo('component-parent-here', 'set-lflbStory', $lflbStory->id);
            }
        }
        $this->search = "";
    }

    public function select(LflbStory $lflbStory)
    {
        if ( ! $this->lflbStories->contains('id', $lflbStory->id) ) {
            $this->lflbStories->push($lflbStory->only(['id', 'name']));
            $this->emitTo('component-parent-here', 'set-lflbStory', $lflbStory->id);
        }
    }

    public function remove(int $index)
    {
        $this->lflbStories->forget($index);
        $this->emitTo('component-parent-here', 'remove-lflbStory', $index);
    }

    /** listener */
    public function clear()
    {
        $this->lflbStories = collect([]);
        $this->search = "";
    }

    /** listener */
    public function set_lflbStories(array $lflbStories)
    {
        // This $lflbStories must be an array with ids of lflbStories
        foreach ( $lflbStories as $id ) {
            $lflbStory = LflbStory::find($id);
            $this->lflbStories->push($lflbStory->only(['id', 'name']));
        }
    }

    private function parse_search()
    {
        $temporal = [];
        $temporal = explode(",", $this->search);
        $temporal = array_filter($temporal, 'strlen');
        $temporal = array_map('trim', $temporal);
        return $temporal;
    }
}