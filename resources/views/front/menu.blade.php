<!-- Header -->
	<header id="header" class="alt">
		<nav id="nav">
			<ul>
				<li><a href="/" class="button">Главная</a></li>
				<?php
				$MainCategories = MainMenu::getMainCategories();
				foreach ($MainCategories as $key => $value){
					echo '<li><a href="/category/'.$key.'" class="button">'.$value.'</a>';
					$SubCategories = MainMenu::getSubCategories($key);
						if(!is_null($SubCategories)){
							echo '<ul>';
								foreach($SubCategories as $SubCategory){
									echo '<li><a href="/category/'.$SubCategory->id.'">'.$SubCategory->name.'</a></li>';
								}
							echo '</ul>';
						}
						echo '</li>';
					}
				?>
				<?php if (Auth::check()){
					echo '<li><a class="button" href="#">'.Auth::user()->name.'</a>
							<ul>';
							if(Auth::user()->role == "admin"){
								echo '<li><a href="/adminzone/categories">АдминЗона</a></li>';
							}
							echo '<li><a href="/logout">Выход</a></li>
							</ul>			
						</li>';
					}else{
					echo '<li><a href="#socailAuth" class="button">Вход</a></li>';
   					} 
				?>				
			</ul>
		</nav>
	</header>
