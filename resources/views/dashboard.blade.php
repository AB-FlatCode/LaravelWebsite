<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Welcome   {{auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
         <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col"># SL Number</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>            
              @foreach ($users as $user)
                 <tr>
                  <th>{{ $loop->iteration }}</th>
                  <th>{{ $user->name }}</th>
                  <th>{{ $user->email }}</th>
                  <th>{{ $user->created_at->diffForHumans() }}</th>
                </tr>  
              @endforeach
        
          </tbody>
        </table>
        </div>
       </div>
    </div>
</x-app-layout>
