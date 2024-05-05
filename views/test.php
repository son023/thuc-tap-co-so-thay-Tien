<div class="row">
							<div class="col-xs-12 widget-container-col ui-sortable">
								<div class="widget-box ui-sortable-handle">
									<div class="widget-header">
										<h5 class="widget-title" style="color: #000; font-size: 20px;">Tìm kiếm</h5>
	
										<div class="widget-toolbar">
											<div class="widget-menu">
												<a href="#" data-action="settings" data-toggle="dropdown">
													<i class="ace-icon fa fa-bars"></i>
												</a>
	
											</div>
	
											<a href="#" data-action="fullscreen" class="orange2">
												<i class="ace-icon fa fa-expand"></i>
											</a>
	
											<a href="#" data-action="reload">
												<i class="ace-icon fa fa-refresh"></i>
											</a>
	
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
	
										
										</div>
									</div>
									<div class="widget-body" style="font-family: 'Inria Serif', sans-serif;">
										<div class="widget-main">
											<div class="row">
												<form role="form" class="form-horizontal" id="list-form">
													<div class="form-group">
														<div class="col-xs-12">
															<div class="col-xs-6">
																<label class="name">Tên tòa nhà</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-6">
																<label class="name">Diện tích sàn</label>
																<input class="form-control" type="number" style="border-radius: 20px;">
															</div>
														</div>
														
														<div class="col-xs-12">
															<div class="col-xs-2">
																<label class="name">Quận</label>
																<select class="form-control">
																	<option>---Chọn Quận---</option>
																	<option value="">Quận 1</option>
																	<option value="">Quận 2</option>
																	<option value="">Quận 3</option>
																</select>
															</div>
															<div class="col-xs-5">
																<label class="name">Phường</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-5">
																<label class="name">Đường</label>
																<input class="form-control" type="text">
															</div>

														</div>

														<div class="col-xs-12">
															<div class="col-xs-4">
																<label class="name">Số tầng hầm</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-4">
																<label class="name">Hướng tòa nhà</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-4">
																<label class="name">Hạng tòa nhà</label>
																<input class="form-control" type="number">
															</div>
															
														</div>

														<div class="col-xs-12">
															<div class="col-xs-3">
																<label class="name">Diện tích từ</label>
																<input class="form-control" type="number">
															</div>
															<div class="col-xs-3">
																<label class="name">Diện tích đến</label>
																<input class="form-control" type="number">
															</div>
															<div class="col-xs-3">
																<label class="name">Giá thuê từ</label>
																<input class="form-control" type="number">
															</div>
															<div class="col-xs-3">
																<label class="name">Giá thuê đến</label>
																<input class="form-control" type="number">
															</div>
															
														</div>

														<div class="col-xs-12">
															
															<div class="col-xs-5">
																<label class="name">Tên quản lý</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-5">
																<label class="name">Điện thoại quản lý</label>
																<input class="form-control" type="text">
															</div>
															<div class="col-xs-2">
																<label class="name">Nhân viên quản lý</label>
																<select class="form-control">
																	<option>---Tên nhân viên---</option>
																	<option value="">Nguyễn Viết Văn</option>
																	<option value="">Dương Văn Dự</option>
																	<option value="">Hoàng Đình Hiệp</option>
																</select>
															</div>
														</div>
														<div class="col-xs-12">
															<div class="col-xs-9">
																<label class="checkbox-inline">
																	<input type="checkbox" name="typecode" value="noi-that">Nội Thất
																</label>
																<label class="checkbox-inline">
																	<input type="checkbox" name="typecode" value="tang-tret">Tầng Trệt
																</label>
																<label class="checkbox-inline">
																	<input type="checkbox" name="typecode" value="nguyen-can">Nguyên Căn
																</label>
															</div>
														</div>
														<div class="col-xs-12">
															<div class="col-xs-6">
																<button id="btn-search" type="submit" style="background-color: #5DCC91; color: #fff; border: #5DCC91;">
																	<i class="fa-solid fa-magnifying-glass"></i>
																	<span> Tìm kiếm</span>
																</button>
															</div>
														</div>
													</div>
												</form>
											</div>	
										</div>
									</div>
									<div class="pull-right">
										
											<a href="building-edit.html" style="color: #000;">
												<button title="Thêm tòa nhà" >
													<i class="ace-icon glyphicon glyphicon-plus"></i>
												<span> Thêm tòa nhà </span>
											</button>
											</a>
											
										
										<button title="Xóa tòa nhà">
											<i class="fa-solid fa-trash-can"></i>
											<span> Xóa tòa nhà</span>
										</button>
									</div>
								</div>
							</div>
						</div>	

						<div class="row">
							<div class="col-xs-12" style="margin-top: 30px;">
								<table id="simple-table" style="text-align: center;" class="table table-striped table-bordered table-hover">
									<thead >
										<tr >
											<th class="center">
												<label class="pos-rel">
													<input type="checkbox" class="ace">
													<span class="lbl"></span>
												</label>
											</th>
											<th class="center">Tên tòa nhà</th>
											<th class="center">Địa chỉ</th>
											<th class="center">Số tầng hầm</th>
											<th class="center">Tên quản lý</th>
					 						<th class="center">Số điện thoại</th>
											<th class="center">Diện tích sàn</th>
											<th class="center">Diện tích trống</th>
											<th class="center">Diện tích thuê</th>
											<th class="center">Phí môi giới</th>
											<th class="center">Thao tác</th>
											
										</tr>
									</thead>

									<tbody>
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="ace">
													<span class="lbl"></span>
												</label>
											</td>
											<td>ABC Building</td>
											<td>abc</td>
											<td>abc</td>
											<td>abc</td>
							
											<td>

												<a href="#">ace.com</a>
											</td>
											<td>$45</td>
											<td class="hidden-480">3,330</td>
											<td>Feb 12</td>

											<td class="hidden-480">
												<span class="label label-sm label-warning">Expiring</span>
											</td>

											<td style="text-align: center;">
												<div class="hidden-sm hidden-xs btn-group">
													<button class="btn btn-xs btn-success" onclick="assignmentBuilding(1)" name="buildingid">
														<i class="ace-icon glyphicon glyphicon-list"></i>
													</button>

													<button class="btn btn-xs btn-info">
														<i class="ace-icon fa fa-pencil bigger-120"></i>
													</button>

													<button class="btn btn-xs btn-danger">
														<i class="ace-icon glyphicon glyphicon-trash"></i>
													</button>
												</div>

												<div class="hidden-md hidden-lg">
													<div class="inline pos-rel">
														<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
															<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
															<li>
																<a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																	<span class="blue">
																		<i class="ace-icon fa fa-search-plus bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																	<span class="green">
																		<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																	<span class="red">
																		<i class="ace-icon fa fa-trash-o bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="ace">
													<span class="lbl"></span>
												</label>
											</td>
											<td>Nam Giao Building</td>
											<td>abc</td>
											<td>abc</td>
											<td>abc</td>
							
											<td>

												<a href="#">ace.com</a>
											</td>
											<td>$45</td>
											<td class="hidden-480">3,330</td>
											<td>Feb 12</td>

											<td class="hidden-480">
												<span class="label label-sm label-warning">Expiring</span>
											</td>

											<td style="text-align: center;">
												<div class="hidden-sm hidden-xs btn-group">
													<button class="btn btn-xs btn-success">
														<i class="ace-icon glyphicon glyphicon-list"></i>
													</button>

													<button class="btn btn-xs btn-info">
														<i class="ace-icon fa fa-pencil bigger-120"></i>
													</button>

													<button class="btn btn-xs btn-danger">
														<i class="ace-icon glyphicon glyphicon-trash"></i>
													</button>							
												</div>

												<div class="hidden-md hidden-lg">
													<div class="inline pos-rel">
														<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
															<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
															<li>
																<a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																	<span class="blue">
																		<i class="ace-icon fa fa-search-plus bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																	<span class="green">
																		<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																	<span class="red">
																		<i class="ace-icon fa fa-trash-o bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="ace">
													<span class="lbl"></span>
												</label>
											</td>
											<td>Sky Bear Building</td>
											<td>abc</td>
											<td>abc</td>
											<td>abc</td>
							
											<td>

												<a href="#">ace.com</a>
											</td>
											<td>$45</td>
											<td class="hidden-480">3,330</td>
											<td>Feb 12</td>

											<td class="hidden-480">
												<span class="label label-sm label-warning">Expiring</span>
											</td>

											<td style="text-align: center;">
												<div class="hidden-sm hidden-xs btn-group">
													<button class="btn btn-xs btn-success">
														<i class="ace-icon glyphicon glyphicon-list"></i>
													</button>

													<button class="btn btn-xs btn-info">
														<i class="ace-icon fa fa-pencil bigger-120"></i>
													</button>

													<button class="btn btn-xs btn-danger">
														<i class="ace-icon glyphicon glyphicon-trash"></i>
													</button>
												</div>

												<div class="hidden-md hidden-lg">
													<div class="inline pos-rel">
														<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
															<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
															<li>
																<a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																	<span class="blue">
																		<i class="ace-icon fa fa-search-plus bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																	<span class="green">
																		<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																	<span class="red">
																		<i class="ace-icon fa fa-trash-o bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>


									</tbody>
								</table>
							</div>