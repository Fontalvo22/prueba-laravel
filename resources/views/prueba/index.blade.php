@extends('layout')
@section('content')

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif    

        @if(session()->has('message'))
            <div class="alert alert-success my-4">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('errorMessage'))
            <div class="alert alert-danger my-4">
                {{ session()->get('message') }}
            </div>
        @endif
        @isset($data[0])
            <div class="form-group">
            <select class="form-control" onChange="checkSelectedOption(event)" name="" id="">
                <option value="0">crear nuevo registro</option>
                    @foreach($data as $user)
                    <option formmethod="put" value="{{ $user->id }}">Actualizar registro #{{ $user->id }} </option>
        
                
                    @endforeach
            </select>
            </div>
        @endisset
        
        <form class="mb-3" action="{{route('prueba.store')}}" id="register-form" method="POST">

            @csrf
            @method('POST')

            <input name="email" type="email" required class="form-control my-2" placeholder="Ingrese correo"/>
            <input name="first_name" type="text" required class="form-control my-2" placeholder="Ingrese primer nombre"/>
            <input name="last_name" type="text" required class="form-control my-2" placeholder="Ingrese apellido"/>
            <input name="n_document" type="number" required class="form-control my-2" placeholder="Ingrese numero de documento"/>
            <input name="phone_number" type="number" required class="form-control my-2" placeholder="Ingrese numero de telefono"/>

        </form>
        <button type="submit" class="btn btn-primary" id="submit-btn" data-toggle="modal" data-target="#updateRegisterModal">Enviar datos</button>

        @isset($data[0])
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>EMAIL</th>
                        <th>PRIMER NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>NUMERO DE DOCUMENTO</th>
                        <th>NUMERO DE TELEFONO</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $user)
                        <tr>
                            <td scope="row"> {{$user->id}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->n_document}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>
                                <button class="btn btn-danger" onClick="setDeleteId({{ $user->id }})" data-toggle="modal" data-target="#deleteRegisterModal">
                                    Eliminar
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset

    </div>



    <!-- Modal for create and update-->
    <div class="modal fade" id="updateRegisterModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">
                    Esta seguro que desea realizar esta accion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onClick="confirmSubmit()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for delete-->
    <div class="modal fade" id="deleteRegisterModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-body">
                    Esta seguro que desea eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onClick="confirmDelete()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-form" action="/prueba" method="post">
        @method('DELETE')
        @csrf
        <input type="hidden" name="deleteID" id="deleteId">

    </form>

    <script>
    const form = document.getElementById("register-form")
    const deleteForm = document.getElementById('delete-form');
    const submitBtn = document.getElementById("submit-btn");
    const idToUpdate = document.getElementById("register-id");
    
    const updateRegister = (registerId) => {    
            const formMethod=document.getElementsByName('_method')[0];
            formMethod.value="PATCH";
            form.setAttribute("action", "/prueba/" + registerId);
            

            submitBtn.innerText = "actualizar";   
        }

        const cancelUpdate = () => {
            const formMethod=document.getElementsByName('_method')[0];
            form.setAttribute("action", "/prueba");

            formMethod.value="post";
            submitBtn.innerText = "Enviar datos";    
        }

        const checkSelectedOption = (event) => {
            if(event.target.value == 0){
                cancelUpdate()
            }else{
                console.log(event.target.value);
                updateRegister(event.target.value)
            }
        }
        
        const confirmSubmit = () => {
            form.submit();
        }

        const setDeleteId = (deleteId) => {
            deleteForm.setAttribute("action", "/prueba/" + deleteId);
        }

        const confirmDelete = () => {
            deleteForm.submit();
        }

    </script>

@endsection