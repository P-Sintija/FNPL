@extends('layout')

@section('content')
<div class="flex w-screen h-screen justify-evenly items-center bg-gray-100">
  <form method="post" action="/result" enctype="multipart/form-data" class="w-4/12 h-4/6 justify-between 
    flex flex-col gap-6 bg-blue-200 p-5 rounded">
    @csrf
    <label class="flex justify-around items-center bg-indigo-400 rounded-full text-gray-800 h-10 
      hover:border-gray-400 focus:outline-none appearance-none">
      <span class="text-base leading-normal">
        Select File
      </span>
      <input type='file' class="hidden" name="image" />
    </label>
    <div class="flex justify-between items-center">
      <label class="text-gray-800">
        Format
      </label>
      <select name="recurrence" class="border border-gray-300 rounded-full text-gray-600 h-10 px-5 bg-white 
        hover:border-gray-400 focus:outline-none appearance-none">
        <option value="none">
          No
        </option>
        <option value="non-repeating">
          Non repeating
        </option>
        <option value="least-repeating">
          Least repeating
        </option>
        <option value="most-repeating">
          Most repeating
        </option>
      </select>
    </div>
    <div class="flex justify-between items-center">
      <label class="text-gray-800">
        Include letter
      </label>
      <select name="letter" class="border border-gray-300 rounded-full text-gray-600 h-10 px-5 bg-white 
        hover:border-gray-400 focus:outline-none appearance-none">
        <option value="1">
          Yes
        </option>
        <option value="0">
          No
        </option>
      </select>
    </div>
    <div class="flex justify-between items-center">
      <label class="text-gray-800">
        Include punctuation
      </label>
      <select name="punctuation" class="border border-gray-300 rounded-full text-gray-600 h-10 px-5 bg-white 
        hover:border-gray-400 focus:outline-none appearance-none">
        <option value="1">
          Yes
        </option>
        <option value="0">
          No
        </option>
      </select>
    </div>
    <div class="flex justify-between items-center">
      <label class="text-gray-800">
        Include symbol
      </label>
      <select name="symbol" class="border border-gray-300 rounded-full text-gray-600 h-10 px-5 bg-white 
        hover:border-gray-400 focus:outline-none appearance-none">
        <option value="1">
          Yes
        </option>
        <option value="0">
          No
        </option>
      </select>
    </div>
    <div>
      <button class="w-full flex justify-around items-center bg-indigo-400 rounded-full text-gray-800 h-10 
        hover:border-gray-400 focus:outline-none appearance-none">
        Submit
      </button>
    </div>
  </form>

  @if (count($result) > 0)
  <div class="w-4/12 h-4/6 justify-center flex flex-col gap-6 bg-red-200 p-5 rounded">
    @foreach( $result as $line)
    <p class="text-gray-800">
      {{ $line }}
    </p>
    @endforeach
  </div>
  @endif

</div>
@endsection