<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route("logout") }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route("/") }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="{{ route("regSchool") }}">School</a>
                </li>

                <li>
                    <a href="{{ route("term") }}">Term</a>
                </li>

                <li>
                    <a href="{{ route("examSet") }}">Exam Set</a>
                </li>

                <li>
                    <a href="{{ route("clazz") }}">Class</a>
                </li>


                <?php $classes = \App\Clazz::with("streams")->get() ?>
                @if($classes->count() > 0)
                    <li>
                        <a href="#">Students <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($classes as $class)
                                <?php
                                    $streams = $class->streams;
                                    $count_streams = $streams->count();
                                ?>
                                <li>
                                    <a href="{{ ($count_streams > 0) ? '#' : route("listStudentsBy", ["by" => "class", "id" => $class->id]) }}">{{ $class->name }} @if($count_streams > 0 ) <span class="fa arrow"></span> @endif</a>
                                    @if($count_streams > 0)
                                        <ul class="nav nav-third-level">
                                            @foreach($class->streams as $stream)
                                                <li>
                                                    <a href="{{ route("listStudentsBy",["by" => "stream", "id" => $stream->id]) }}">{{ $stream->name }}</a>
                                                </li>
                                                @endforeach
                                        </ul>
                                        @endif
                                </li>
                                @endforeach

                                <li>
                                    <a href="{{ route("importStudents") }}">Import Students</a>
                                </li>
                        </ul>
                    </li>
                    @endif

                <li>
                    <a href="#">Subject <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="{{ route("subject") }}">Subjects</a></li>
                        <li> <a href="{{ route("classSubject") }}">Class Subjects</a></li>
                    </ul>
                </li>


                <li>
                    <a href="{{ route("grading") }}">Grading</a>
                </li>

                {{--  <li>
                    <a href="#">Grading<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="{{ route("grading") }}">Grading</a></li>
                        <li> <a href="{{ route("grading") }}">Class Grading</a></li>
                    </ul>
                </li>  --}}

                @if($classes->count() > 0)
                    <li>
                        <a href="#">Report Config<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($classes as $class)
                                <li> <a href="{{ route("reportConfig", ["class" => $class->id]) }}">{{ $class->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if($classes->count() > 0)
                    <li>
                        <a href="#">Marks <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($classes as $class)
                                <?php
                                $streams = $class->streams;
                                $count_streams = $streams->count();
                                ?>
                                <li>
                                    <a href="{{ ($count_streams > 0) ? '#' : route("marks", ["by" => "class", "id" => $class->id]) }}">{{ $class->name }} @if($count_streams > 0 ) <span class="fa arrow"></span> @endif</a>
                                    @if($count_streams > 0)
                                        <ul class="nav nav-third-level">
                                            @foreach($class->streams as $stream)
                                                <li>
                                                    <a href="{{ route("marks",["by" => "stream", "id" => $stream->id]) }}">{{ $stream->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if($classes->count() > 0)
                    <li>
                        <a href="#">Results <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($classes as $class)
                                <?php
                                $streams = $class->streams;
                                $count_streams = $streams->count();
                                ?>
                                <li>
                                    <a href="{{ ($count_streams > 0) ? '#' : route("results", ["by" => "clazz", "id" => $class->id]) }}">{{ $class->name }} @if($count_streams > 0 ) <span class="fa arrow"></span> @endif</a>
                                    @if($count_streams > 0)
                                        <ul class="nav nav-third-level">
                                            @foreach($class->streams as $stream)
                                                <li>
                                                    <a href="{{ route("results",["by" => "stream", "id" => $stream->id]) }}">{{ $stream->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if($classes->count() > 0)
                    <li>
                        <a href="#">Report Cards <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @foreach($classes as $class)
                                <?php
                                $streams = $class->streams;
                                $count_streams = $streams->count();
                                ?>
                                <li>
                                    <a href="{{ ($count_streams > 0) ? '#' : route("reportCards", ["by" => "clazz", "id" => $class->id]) }}">{{ $class->name }} @if($count_streams > 0 ) <span class="fa arrow"></span> @endif</a>
                                    @if($count_streams > 0)
                                        <ul class="nav nav-third-level">
                                            @foreach($class->streams as $stream)
                                                <li>
                                                    <a href="{{ route("reportCards",["by" => "stream", "id" => $stream->id]) }}">{{ $stream->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>