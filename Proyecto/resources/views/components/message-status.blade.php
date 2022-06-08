@props(['status'])

@if ($status)
<div class="text-white px-6 py-4 border-0 rounded relative mb-4" style="background-color: rgb(161 98 7);">
   <span class="text-xl inline-block mr-5 align-middle">
     <i class="fas fa-bell"></i>
   </span>
   <span class="inline-block align-middle mr-8">
      {{ $status }}
   </span>
   <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
     <span>×</span>
   </button>
 </div>
 <script>
   function closeAlert(event){
     let element = event.target;
     while(element.nodeName !== "BUTTON"){
       element = element.parentNode;
     }
     element.parentNode.parentNode.removeChild(element.parentNode);
   }
 </script>
{{-- 
<div class="px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
   <p> {{ $status }}</p>
 </div> --}}
@endif