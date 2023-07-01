@extends('master')											
			@section('content')											
			<div class="inner-header">											
				<div class="container">										
					<div class="pull-left">									
						<h6 class="inner-title">Sản phẩm</h6>								
					</div>									
					<div class="pull-right">									
						<div class="beta-breadcrumb font-large">								
							<a href="/mas">Home</a> / <span>Sản phẩm</span>							
						</div>								
					</div>									
					<div class="clearfix"></div>									
				</div>										
			</div>											
			<div class="container">											
				<div id="content" class="space-top-none">										
					<div class="main-content">									
						<div class="space60">&nbsp;</div>								
						<div class="row">								
							<div class="col-sm-3">							
								<ul class="aside-menu">	

									 @foreach(($loai) as $l)
                                    <li><a href="/type/{{$l->id}}">{{$l->name}}</a></li>
                                    @endforeach				
										
								</ul>						
							</div>							
							<div class="col-sm-9">							
								<div class="beta-products-list">						
									<h4>New Products</h4>					
									<div class="beta-products-details">					
										<p class="pull-left">Tim thay {{count($sp_theoloai)}} san pham</p>				
										<div class="clearfix"></div>				
									</div>					
														
									<div class="row">					
									@foreach($sp_theoloai as $sp)					
										<div class="col-sm-4">				
											<div class="single-item">			
											@if($sp->promotion_price!=0)			
											<div class ="ribbon-wrapper"><div class ="ribbon sale">i love you</div></div>			
											@endif			
												<div class="single-item-header">		
													<a href="product.html"><img src="../source/image/product/{{$sp->image}}" alt=""></a>	
												</div>		
												<div class="single-item-body" style="font-size: 18px">		
													<p class="single-item-title" >{{$sp->name}}</p>	
													<p class="single-item-price">	
														@if($sp->promotion_price==0)
														<span class="flash-sale">{{number_format($sp->unit_price)}}đồng</span>
													@else	
														<span class="flash-del">{{number_format($sp->unit_price)}}đồng</span>
														<span class="flash-sale">{{number_format($sp->promotion_price)}}đồng</span>
													@endif	
													</p>	
												</div>		
												<div class="single-item-caption">		
													<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>	
													<a class="beta-btn primary" href="../detail/{{$sp->id}}">Details <i class="fa fa-chevron-right"></i></a>	
													<div class="clearfix"></div>	
												</div>		
											</div>			
										</div>				
									@endforeach					
									</div>					
														
								</div> <!-- .beta-products-list -->						
														
								<div class="space50">&nbsp;</div>						
														
								<div class="beta-products-list">						
									<h4>Top Products- SAN PHAM KHAC</h4>					
									<div class="beta-products-details">					
										<p class="pull-left">Tim thay {{count($sp_khac)}} san pham</p>				
										<div class="clearfix"></div>				
									</div>					
									<div class="row">					
									@foreach($sp_khac as $sp_khac)					
										<div class="col-sm-4">				
											<div class="single-item">			
												<div class="single-item-header">		
													<a href="product.html"><img src="../source/image/product/{{$sp_khac->image}}" alt=""></a>	
												</div>		
												<div class="single-item-body" style="font-size: 18px">		
													<p class="single-item-title" >{{$sp_khac->name}}</p>	
													<p class="single-item-price">	
														@if($sp_khac->promotion_price==0)
														<span class="flash-sale">{{number_format($sp_khac->unit_price)}}đồng</span>
													@else	
														<span class="flash-del">{{number_format($sp_khac->unit_price)}}đồng</span>
														<span class="flash-sale">{{number_format($sp_khac->promotion_price)}}đồng</span>
													@endif	
													</p>	
												</div>		
												<div class="single-item-caption">		
													<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>	
													<a class="beta-btn primary" href="../../detail/{{$sp_khac->id}}">Details <i class="fa fa-chevron-right"></i></a>	
													<div class="clearfix"></div>	
												</div>		
											</div>			
										</div>				
									@endforeach					
									</div>					
														
									<div class="space40">&nbsp;</div>					
														
								</div> <!-- .beta-products-list -->						
							</div>							
						</div> <!-- end section with sidebar and main content -->								
														
														
					</div> <!-- .main-content -->									
				</div> <!-- #content -->										
			</div> <!-- .container -->											
			@endsection											
