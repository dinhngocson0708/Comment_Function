@php
		 $gio= gmdate("H",time()+3600*7); @endphp
		@if($gio< 12)
			chao buoi sang
		@elseif ($gio< 18)
			chao buoi chieu
		@else
			chao buoi toi
	    @endif




@for ($i=0;$i< 4;$i++)
    @for($j=0;$j< 4;$j++)
        <div style=""></div>
    @endfor
@endfor