<?php
include 'loadingDetails.php';
$linkedin_link=LoadLinkedinLink($conn);
$github_link=LoadGithubLink($conn);
$personalwebsite_link=LoadPersonalWebsiteLink($conn);

// THE BELOW FUNCTION LOADS NAVBAR CONTENT AND DATA. 
function LoadNavbar($conn,$user_name)
{?>
  <nav id="navbar" class="navbar navbar-expand-md fixed-top navbar-dark bg-dark navbar-scroll">
      <div class="container">
        <a class="navbar-brand" href="#home"><?php echo $user_name["c2"];?></a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarCenteredExample"
          aria-controls="navbarCenteredExample" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarCenteredExample">
          <ul class="navbar-nav mb-lg-0">


            <?php
            $section_order_array=SectionOrder($conn);
            foreach ($section_order_array as $key => $value) {

                if($value=='hero'){
                  $name='home';
                }

                elseif($value=='footer')
                {
                  $name='contact';
                }
                else
                {
                  $name=$value;
                }
                
                ?>

              <!-- NAVBAR CONTENT LOADED HERE -->
              <li class="nav-item px-2">
                <a id="<?php echo "mynavlink-".$value;?>" class="nav-link" href="<?php echo "#".$name;?>"><?php echo ucfirst($name);?></a>
              </li>


              <?php
            }

            ?>

          </ul>
        </div>
      </div>
    </nav>

<?php  
}


// LOADS THE HERO SECTION OF THE PAGE.
// MODIFY AS PER YOUR REQUIREMENT. BE CAREFUL WHILE MODIFYING THE PARTS OF CODE WHERE THE DATA LOADS
function LoadHeroSection($conn,$user_name)
{?>
  <section id="home" class="even-section">

    
    <div class="p-5 text-center bg-image hero-page">
      
      <div class="container">
        <div class="row">
          <div class="col-lg-6 text-white hero-content-container">
            
            <p class="hero-content-heading1">Hi, I am <?php echo $user_name["c2"];?></p>
            <p class="fw-bold hero-content-heading2">

              <!-- DATA FROM DB LOADS HERE -->
              <?php 
                $home_description_query = "SELECT c1, c2 FROM home_section WHERE c1='home-section-description'";
                $home_description = mysqli_fetch_assoc($conn->query($home_description_query));
                echo $home_description["c2"];
              ?>

            </p>
          </div>
          
        </div>
      </div>
      
    </div>
  </section>
<?php
}

// LOAD THE ABOUT ME SECTION
function LoadAboutMe($conn,$user_name)
{?>
<section id="about" class="about-me even-section">
    <?php
      $about_description_query = "SELECT c1, c2 FROM about_me WHERE c1='background'";
      $about_description = mysqli_fetch_assoc($conn->query($about_description_query));
    ?>


    <div class="container" data-mdb-toggle="animation" data-mdb-animation-start="onScroll"
      data-mdb-animation="fade-in-up" data-mdb-animation-delay="300" data-mdb-animation-offset="10">
      <p class="pb-1 display-6 fw-bold ls-tight text-center">About Me</p>

      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
          <h5 class="mb-4 text-center">Background and Interests</h5>
          <p>
            <?php echo $about_description["c2"];?>
          </p>
        </div>

        <?php
        // LOAD SKILLS
        $skills_query = "SELECT c2 FROM about_me WHERE c1='skills'";
        $skills = mysqli_fetch_assoc($conn->query($skills_query));
        foreach ($skills as $value) {
          $x=$value;
        }
        $skills_split=explode(",", $x);

      ?>

        <div class="col-md-6 col-lg-6 col-sm-12 justify-content-center">
          <h5 class="mb-4 text-center">Skills</h5>
          
          <?php
            
            foreach ($skills_split as $variable) {
              ?>
              <div class="skill-item px-4 py-2"><?php echo $variable?></div>
              <?php
            }
            ?>
          
          <div class="grid grid-cols-5 gap-2"></div>
        </div>
      </div>
    </div>
  </section>

<?php
}


// LOAD THE PROJECTS SECTION.
function LoadProjectSection($conn,$user_name,$github_link)
{?>
<section id="projects" class="text-center projects even-section">

    <div class="container" data-mdb-toggle="animation" data-mdb-animation-start="onScroll"
      data-mdb-animation="fade-in-up" data-mdb-animation-delay="300" data-mdb-animation-offset="10">
      <h2 class="text-center mb-5 display-6 fw-bold ls-tight text-center">
        Projects
      </h2>

      <div class="container">
        <div class="row">

        <?php  
        $skills_query = "SELECT * FROM projects";
        $result=mysqli_query($conn, $skills_query);

        if (mysqli_num_rows($result) > 0) {
          // $c variable to keep count. Load only top 6 rows
          $c=0;
          while($row = mysqli_fetch_assoc($result)) {
            $c=$c+1;
            if($c>6)
            {
              break;
            }
            $links=$row["project_links"];
            $links_split=explode(";", $links);
            
              ?>
              <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch g-2">
                <div class="card">
                  <div class="card-body">
                    <h5 class="project-card-title"><?php echo $row["project_title"];?></h5>

                    <p class="card-text">
                      <?php echo $row["project_description"];?>
                    </p>

                    <?php
                      for ($i=0; $i < count($links_split); $i++) { 
                              $links_split_2=explode(",", $links_split[$i]);
                              
                             ?>

                        <a href="<?php echo $links_split_2[1];?>" class="card-link"><?php echo $links_split_2[0];?></a>
              
                        <?php
                                  }

                      ?>
                    

                  </div>
                </div>
              </div>


        <?php

          }
        }

    ?>

        </div>
      </div>

      <a class="btn align-items-center mt-5 projects-see-more-external-button" href="<?php echo $github_link;?>"
        target="_blank">See More Projects</a>
    </div>
  </section>


<?php
}

// LOAD EDUCATION AND EXPERIENCE SECTION
function LoadExperienceSection($conn,$user_name)
{?>
<section id="experience" class="even-section">
    <h1 class="text-center py-4">Education and Experience</h1>
    <div class="container py-5">
      <div class="main-timeline">

        <?php
          $experience_query="SELECT * FROM experience";
          $experience_query_rows =mysqli_query($conn, $experience_query);
          
          $experience_title_arr=array();
          $experience_org_arr=array();
          $experience_skills_arr=array();

          while($row = mysqli_fetch_assoc($experience_query_rows))
          {   
              $experience_title_arr[]=$row["experience_title"];
              $experience_org_arr[]=$row["experience_org"];
              $experience_skills_arr[]=$row["experience_skills"];
          }


          $d="right";
          $c=count($experience_title_arr);
          for($x=0;$x<$c;$x++)
          { 
            
            if($x%2==0)
            {
              $d="right";
            }
            else
            {
              $d="left";
            }
            ?>

              <div class="timeline <?php echo $d;?>">
                <div class="card">
                  <div class="timeline-card-body">
                    <p class="timeline-card-title"><?php echo $experience_title_arr[$x];?></p>
                    <p class="timeline-card-subtitle"><?php echo $experience_org_arr[$x];?></p>

                    <h6>Relevent Technologies and Coursework:</h6>
                    <?php
                      $skills_split2=explode(";", $experience_skills_arr[$x]);
                      foreach ($skills_split2 as $variable) {
                        ?>
                        <h6 class="badge bg-dark text-white mb-0"><?php echo $variable;?></h6>
                        <?php
                      }
                    ?>
                    
                  </div>
                </div>
              </div>

            <?php

          }


        ?>
      </div>
    </div>
  </section>

<?php
}

// LOAD FOOTER SECTION
function LoadFooterSection($conn,$user_name,$linkedin_link,$github_link,$personalwebsite_link)
{?>
<section id="contact" class="footer">
    <!-- Footer -->
    <footer class="text-center text-lg-start">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-center justify-content-ltimeline-g-between border-bottom container">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
          <span>Connect with me on social:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="<?php echo $linkedin_link;?>" class="me-4 text-reset">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="<?php echo $github_link;?>" class="me-4 text-reset">
            <i class="fab fa-github"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <section class="">
        <div class="container text-center text-md-start mt-5">
          <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <p class="fw-bold mb-4 footer-title"><?php echo $user_name["c2"];?></p>
              <p>
                <?php echo LoadFooterDescription($conn);?>
              </p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <p class="fw-bold mb-4 footer-title">Useful links</p>
              
              <p>
                <a href="<?php echo $linkedin_link;?>" class="text-reset" target="_blank">LinkedIn</a>
              </p>
              <p>
                <a href="<?php echo $github_link;?>" class="text-reset" target="_blank">Github</a>
              </p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <p class="fw-bold mb-4 footer-title">Contact</p>
              <p>
                <i class="fas fa-home me-3"></i> <?php echo LoadFooterAddress($conn);?>
              </p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                <?php echo LoadFooterEmail($conn);?>
              </p>
            </div>
          </div>
        </div>
      </section>
    </footer>
    <!-- Footer -->
  </section>


<?php
}


?>