<include file="Tpl:head"/>

                <div class="About">
                    <div class="About_head">
                        <div class="About_title">
                            <span>产品中心</span>
                        </div>
                    </div>
                </div>

                <div class="Product_center_x">
                
                <foreach  name="list"  item="vo1">
					<div>
						<div class="Product_center_y">
							<span class="bg_span">{$typelist[$key]}</span>
						</div>
						<ul class="Product_center_ul" style = "display:block;">
						
							<volist name="vo1" id="vo">
								<li>
									<a href="{:U('show', array('id' => $vo['id']))}">
										{$vo.fund_product_name}
									</a>
								</li>
							</volist>
	 
						</ul>
					</div>
                    
                </foreach>
                </div>
				<script type="text/javascript">
					$(function(){
						$(".Product_center_y span").click(function(){
							$(this).toggleClass("bg_span");
							$(this).parent().siblings().slideToggle();
						})

					})
				</script>

<include file="Tpl:foot"/>