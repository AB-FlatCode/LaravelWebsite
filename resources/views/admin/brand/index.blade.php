<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      All Brands
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
              All Brands
            </div>      
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"># SL Number</th>
                  <th scope="col">Brand Name</th>
                  <th scope="col">Brand Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($brands as $brand)
                <tr>
                  <td>{{ $brands->firstItem()+$loop->index }}</td>
                  <td>{{ $brand->brand_name }}</td>
                  <td><img src="{{ asset($brand->brand_img) }}" alt="" style="width:120px" height="auto"></td>
                  <td>{{ $brand->created_at }}</td>           
                  <td>
                    <a class="btn btn-info" href="{{ route('edit.brand', $brand->id) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('delete.brand', $brand->id) }}" onclick="return confirm('Are you sure to delete?')">Delete</a>
                  </td>
                </tr> 
                @endforeach               
              </tbody>
            </table>
            {{ $brands->links() }}
        </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">Create a Brand</div>
            <div class="card-body">
            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Brand Name</label>
                <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('brand_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror            
              </div>

              <div class="form-group">
                <label for="brandImage">Brand Image</label>
                <input type="file" name="brand_img" class="form-control" id="brandImage" aria-describedby="brandImage">
                @error('brand_img')
                  <span class="text-danger">{{ $message }}</span>
                @enderror            
              </div>
              <button type="submit" class="btn btn-primary">Add New Brand</button>
            </form>
          </div>
          </div>

        </div>
     
      </div>
     </div>

  </div>
</x-app-layout>
