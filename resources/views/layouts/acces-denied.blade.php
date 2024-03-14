<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800"> {{Auth()->user()->name}} Jij bent geblocked</span>
                    <img src="{{asset('/storage/images/access-denied.jpg')}}" alt="access-denied">
                </div>
            </div>
    </div>

</div>