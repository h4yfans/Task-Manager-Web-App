@extends('layouts.master')

@include('includes.header')


@section('styles')
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

@endsection

@include('includes.info')

@section('content')
    <form action="{{route('add.task')}}" method="post">
        <div class="row add-task col s12">
            <div class="input-field col s3 offset-s4">
                <textarea id="task_name" name="task_name" type="text" class="validate"></textarea>
                <label for="task_name">Add Name</label>
            </div>
            <button type="submit" class="btn btn-task">add</button>
            @if(Session::has('message'))
                <label class="info-task success">{{Session::get('message')}}</label>
            @endif
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </div>
    </form>

    <table class="container centered">
        <thead>
        <tr>
            <th>
                Task Name
            </th>
            <th>
                Created At
            </th>
            <th>
                Updated At
            </th>
            <th>
                Change
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            @if(Auth::user() == $task->user)
                <tr class="task" data-taskid="{{$task->id}}" data-taskbody="{{$task->task}}">
                    <td>{{$task->task_name}}</td>
                    <td>{{$task->created_at->format('m/d/Y')}}</td>
                    <td>{{$task->updated_at->format('m/d/Y')}}</td>
                    <td class="change">
                        <a class="btn edit waves-effect waves-light modal-trigger" href="#modal1" type="submit">Edit</a>
                        <a class="btn delete waves-effect waves-light delete" type="submit" href="{{route('task.delete', ['task_id' => $task->id])}}">Delete</a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>




    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <label for="task-body">Task</label>
            <textarea name="task-body" id="task-body" cols="30" style="height: 200px">My Task</textarea>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" id="modal-save">Update</a>
        </div>
    </div>

    <script>
        var urlEdit = '{{route('edit')}}';
        var token = '{{Session::token()}}';
        $(document).ready(function () {
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        });
    </script>

@endsection


@section('script')
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script src="{{URL::asset('js/materialize.min.js')}}"></script>
@endsection