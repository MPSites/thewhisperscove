    <div class="main-content">
        <div class="home-left-content-area"> 
        <?php 
            include 'models/functions/functions.php';

            $posts = front_top();
           // print_r($posts);
           foreach($posts as $post):
        ?>
            <div class="post-row">
				<div class="blog-post">
					
					<div class="blog-post-inner">
						<a href="#" class="post-about">	
							<div class="post-member">
								<img src="assets/img/user_images/<?= $post->avatar_img ?>" alt="avatar-image">
								<span class="post-user"><?= $post->username ?></span>
								<span class="acc-role"><?= $post->role_name ?></span>
							</div>
						</a>
						<div class="post-content">
							<h2 class="blog-post-title"><?= $post->title ?></h2>
							<p><?= $post->content ?></p>
						</div>
					</div>
					<div class="post-date">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php 
                        
                            $date = time_elapsed_string($post->post_date);
                            echo $date;
                        ?>
						
					</div>
				</div>
			</div>

           <?php endforeach; ?>

        </div>
        
        <div class="content-sidebar">
            <div class="side-box">
                <h3 class="side-title">About Us</h3>
                <p class="side-par">The Whisper's Cove is meant to be a forum dedicated to the Monkey Island game series and the people around it. 
                    We see ourselves as a part of that community, and we made this place so that the people can share they're passion
                    for the games, aswell as help others on the way, and we see it as a cool geeky nostalgic place where we can hang out and talk
                    to other people and share our stories of the good old days.
                </p>
            </div>
            <div class="side-box">
                <h3 class="side-title">Users</h3>
                    <?php
                    $user_count = user_count();
                    $suffix = ($user_count != 1) ? 's' : '' ;
                    ?>
                    <ul>
                        <li>
                            We currently have <?php echo $user_count; ?> registered user<?= $suffix ?>.
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
    <div class="home-community">
        <div class="container">
            <div class="home-comm-text">
                <div class="home-text-box commbox">
                    <h1>Join the Community</h1>
                    <p>
                    Become a member of The Cove and begin to discover the wild world that is Caribbean with other members of our community. Join our forums, share your story and suggestions. Discuss story and lore, and discover "tresures" with others!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="home-origins">
        <div class="container">
            <div class="home-textbox-holder">
                    <div class="home-text-box">
                        <h2>Origins</h2>
                        <p>Monkey Island is a series of adventure games. 
                            The first four games in the series were produced and published by LucasArts, formerly known as Lucasfilm Games. 
                            The fifth installment of the franchise was developed by Telltale Games in collaboration with LucasArts. The games follow the misadventures of the hapless Guybrush Threepwood as he struggles to become the most notorious pirate in the Caribbean, 
                            defeat the plans of the evil undead pirate LeChuck and win the heart of governess Elaine Marley. Each game's plot usually involves the mysterious Monkey Island and its impenetrable secrets.
                        </p>
                    </div>
                    <div class="home-text-box">
                        <h2>Games Setting</h2>
                        <p>Each of the games takes place on fictional islands in the Caribbean around the Golden Age of Piracy sometime between the 17th and 18th centuries. The islands teem with pirates dressed in outfits that seem to come from films and comic books rather than history, and there are many deliberate anachronisms and references to modern-day popular culture.  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-about-game">
        <div class="container">
            <div class="home-about-text">
                <div class="home-text-box">
                    <h1>Game Info</h1>
                    <ol class="info-list">
                        <li>Developed by - LucasArts (1990–2010), Telltale Games (2009)</li>
                        <li>Platforms: <br/> Atari ST, Amiga, DOS, Microsoft Windows, macOS, Mega-CD, <br/> PlayStation 2, XBLA, WiiWare, PSN, iOS</li>
                        <li>Release: <br/> First release - The Secret of Monkey Island 1990 <br/> Latest release - Monkey Island 2: LeChuck's Revenge − Special Edition 2010</li>
                        <li>Genre(s): Graphic adventure</li>
                        <li>Mode(s): Single-player</li>
                        <li>Creator: Ron Gilbert</li>
                        <li>Writer(s): Ron Gilbert, Dave Grossman, Tim Schafer</li>
                        <li>Composer(s): Michael Land, Patrick Mundy</li>
                        <li>Website <a href="https://scummbar.com/" target="_blank"> www.Scummbar.com</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
