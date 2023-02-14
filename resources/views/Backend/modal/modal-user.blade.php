<div class="modal-content">
    <form class="" id="formAction" action="{{ $User->id ? route('user.update',$User->id) : route('user.simpan') }}" method="POST">
        <div class="modal-header">
            <h3 class="modal-title" id="myLargeModalLabel" style="color: black">
                <strong>
                    @if ($User->id) Ubah
                    @else Tambah
                   @endif Data User
               </strong>
            </h3>
        </div>
        <div class="modal-body m-2">
           @csrf
           @if ($User->id)
           @method('put')
           @endif
           <div class="row">
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Nama User</label>
                       <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="nama_user" value="{{ $User->name }}">
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Email User</label>
                       <input type="email" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="email_user" value="{{ $User->email }}">
                   </div>
               </div>
           </div>

           <div class="row mt-4">
               <div class="col">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Password</label>
                       <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="password" required value="{{$User->password}}">
                   </div>
               </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Role User</label>
                        <select class="form-control ubah_alamat"  style="width: 100%" id="exampleFormControlSelect1" name="role" id="role">
                            <option selected>--Pilih Role--</option>
                            <option value="1">Admin</option>
                            <option value="0">Karyawan</option>
                        </select>
                    </div>
                </div>
            </div>
           </div>
           <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
           </div>
       </form>
   </div>


   <script>
     $(document).ready(function() {
            $('.ubah_alamat').select2({
                dropdownParent: $('#modalAction .modal-content')
            });
        });
   </script>