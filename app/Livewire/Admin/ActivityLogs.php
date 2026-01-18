<?php

namespace App\Livewire\Admin;

use App\Exports\ActivityLogsExport;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ActivityLogs extends Component
{
    use WithPagination;

    public $filterRole = 'all';

    public $filterAction = 'all';

    public $search = '';

    public $selectedLog = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRole()
    {
        $this->resetPage();
    }

    public function updatingFilterAction()
    {
        $this->resetPage();
    }

    public function viewLog($logId)
    {
        $this->selectedLog = ActivityLog::with('user')->findOrFail($logId);
        $this->dispatch('open-modal', 'log-detail-modal');
    }

    public function closeModal()
    {
        $this->selectedLog = null;
        $this->dispatch('close-modal', 'log-detail-modal');
    }

    public function export()
    {
        $filters = [
            'filterRole' => $this->filterRole,
            'filterAction' => $this->filterAction,
            'search' => $this->search,
        ];

        $filename = 'activity-logs-'.now()->format('Y-m-d-His').'.xlsx';

        return Excel::download(new ActivityLogsExport($filters), $filename);
    }

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->when($this->filterRole !== 'all', function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('role', $this->filterRole);
                });
            })
            ->when($this->filterAction !== 'all', function ($query) {
                $query->where('action', $this->filterAction);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('action', 'like', '%'.$this->search.'%')
                        ->orWhere('model_type', 'like', '%'.$this->search.'%')
                        ->orWhereHas('user', function ($u) {
                            $u->where('name', 'like', '%'.$this->search.'%')
                                ->orWhere('email', 'like', '%'.$this->search.'%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => ActivityLog::count(),
            'admin' => ActivityLog::whereHas('user', fn($q) => $q->where('role', 'admin'))->count(),
            'staff' => ActivityLog::whereHas('user', fn($q) => $q->where('role', 'staff'))->count(),
            'customer' => ActivityLog::whereHas('user', fn($q) => $q->where('role', 'customer'))->count(),
        ];

        $actions = ActivityLog::distinct()->pluck('action')->sort()->toArray();

        return view('livewire.admin.activity-logs', [
            'logs' => $logs,
            'stats' => $stats,
            'actions' => $actions,
        ]);
    }
}
