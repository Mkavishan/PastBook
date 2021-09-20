@extends('layouts.app')

@section('content')
    <div class="row justify-content-between">
        <div class="col-md-8">
            @if (\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (\Illuminate\Support\Facades\Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#imageModal">
                Upload New
            </button>
        </div>
    </div>

    <br />

    <div>
        @foreach ($images->chunk(3) as $chunk)
            <div class="card-group">
                @foreach($chunk as $image)
                    <div class="card image" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset($image->path) }}" alt="Card image cap">
                        <div class="edit">
                            <a data-toggle="modal" data-target="#imageModal" onclick="editImage({{ $image->id }})">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="imageForm" name="imageForm" action="{{ url('/images') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="formPutMethod" type="hidden" name="_method" value="put" disabled>

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-row" id="preview-image">
                            <div class="form-group col-md-12">
                                <img id="preview" src="#" alt="preview" width="100%" height="100%">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="image">Image</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let previewImage = document.getElementById('preview-image');
        let image = document.getElementById('image');

        previewImage.style.display = 'none';

        image.onchange = (event) => {
            const [file] = image.files;

            if (file) {
                previewImage.style.display = 'block';
                console.log(file);
                preview.src = URL.createObjectURL(file);
            }
        }

        function editImage(id) {
            document.getElementById('formPutMethod').disabled = false;
            var imageForm = document.getElementById('imageForm');
            imageForm.action = imageForm.action + '/' + id;
        }
    </script>
@endsection
