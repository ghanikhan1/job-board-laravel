<x-layout>
    <x-bread-crumbs :links="['My Jobs' => '#']" class="mb-4"/>

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-job.create') }}">Add new</x-link-button>
    </div>

    @forelse($jobs as $job)
        <x-job-card :job="$job">
            <div class="text-xs text-slate-500">
                @forelse($job->jobApplications as $application)
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <div>{{ $application->user->name }}</div>
                            <div>Applied {{ $application->created_at->diffForHumans() }}</div>
                            <div>Download CV</div>
                        </div>
                        <div>${{number_format($application->expected_salary)}}</div>
                    </div>
                @empty
                    <div>No applications yet</div>
                @endforelse

                <div class="flex space-x-2 items-center">
                    <x-link-button href="{{ route('my-job.edit', $job) }}">Edit</x-link-button>

                    <form action="{{route('my-job.destroy', $job)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No Jobs Yet
            </div>
            <div class="center">
                Post your first job
                <a class="text-indigo-500 hover:underline"
                   href="{{ route('my-job.create') }}">here</a>
            </div>
        </div>
    @endforelse
</x-layout>
