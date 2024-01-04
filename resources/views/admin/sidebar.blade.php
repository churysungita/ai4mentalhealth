 <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    AI4<span>MH</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                    
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard')}}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">web pages</li>
                  
                    <li class="nav-item">
                        <a href="{{ route('admin.about-us.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="message-square"></i>
                            <span class="link-title">About Us</span>
                        </a>
                    </li>

                       <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="calendar"></i>
                            <span class="link-title">Contacts</span>
                        </a>
                    </li>

                       <li class="nav-item">
                        <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="calendar"></i>
                            <span class="link-title">Blogs</span>
                        </a>
                    </li>
                  
                   
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages1" role="button" aria-expanded="false" aria-controls="general-pages">
                            <i class="link-icon" data-feather="book"></i>
                            <span class="link-title">Publications</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="general-pages1">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.conference_papers.index') }}" class="nav-link">Conference Paper</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.journal_papers.index') }}" class="nav-link">Journal Paper</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Research</a>
                                </li>



                            </ul>
                        </div>
                    </li>

 

                    <li class="nav-item">
                        <a href="{{ route('admin.teams.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="calendar"></i>
                            <span class="link-title">Our Team</span>
                        </a>
                    </li>

                       <li class="nav-item">
                        <a href="{{ route('admin.testimonial') }}" class="nav-link">
                            <i class="link-icon" data-feather="calendar"></i>
                            <span class="link-title">Testimonials</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Components</li>


                    <li class="nav-item nav-category">Pages</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
                            <i class="link-icon" data-feather="book"></i>
                            <span class="link-title">Web settings</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="general-pages">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.slideshow.index') }}" class="nav-link">Slide show</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#errorPages" role="button" aria-expanded="false" aria-controls="errorPages">
                            <i class="link-icon" data-feather="cloud-off"></i>
                            <span class="link-title">Error</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="errorPages">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">404</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">500</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>