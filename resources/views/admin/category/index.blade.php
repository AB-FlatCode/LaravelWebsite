<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      All Categories
      </h2>
  </x-slot>

  <div class="py-12">
     <div class="container">
       <div class="row">
        <div class="col-md-8">
          @if (session('success'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
          @endif
          <div class="card">         
            <div class="card-header">
              All Categories
            </div>
         
          <table class="table">
            <thead>
              <tr>
                <th scope="col"># SL Number</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody> 
  
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $categories->firstItem()+$loop->index}}</td>
                  <td>{{ $category->category_name }}</td>
                  <td>{{ $category->created_at }}</td>
                  <td>{{ $category->user->name }}</td>
                  <td>
                    <a class="btn btn-info" href="{{ route('edit.category', $category->id) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('softdelete.category', $category->id) }}">Trash</a>
                  </td>
                </tr> 
              @endforeach            
            </tbody>
          </table>
          {{ $categories->links() }}
        </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Create Category</div>
            <div class="card-body">
            <form action="{{ route('store.category') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                @error('category_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
           
              </div>
              <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
          </div>
          </div>

        </div>
     
      </div>
     </div>

     {{-- Trashed Part --}}

     <div class="container">
      <div class="row">
       <div class="col-md-8">
     
         <div class="card">         
           <div class="card-header">
             Trash List
           </div>       
         <table class="table">
           <thead>
             <tr>
               <th scope="col"># SL Number</th>
               <th scope="col">Name</th>
               <th scope="col">Created At</th>
               <th>Username</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody> 
 
             @foreach ($trashCats as $trashCat)
               <tr>
                 <td>{{ $trashCats->firstItem()+$loop->index}}</td>
                 <td>{{ $trashCat->category_name }}</td>
                 <td>{{ $trashCat->created_at }}</td>
                 <td>{{ $trashCat->user->name }}</td>
                 <td>
                   <a class="btn btn-info" href="{{ route('restore.category', $trashCat->id) }}">Restore</a>
                   <a class="btn btn-danger" href="{{ route('delete.category' , $trashCat->id) }}">Delete</a>
                 </td>
               </tr> 
             @endforeach            
           </tbody>
         </table>
         {{ $trashCats->links() }}
       </div>
       </div>

       <div class="col-md-4">

       </div>
    
     </div>
    </div>
  </div>
</x-app-layout>
