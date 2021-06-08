<div class="userView">
    <div class="user_img">
        <div class="img">
            <img src="https://preview.keenthemes.com/metronic-v4/theme/assets/pages/media/profile/profile_user.jpg" alt="..." class="img-thumbnail">
        </div>
        <div class="info">
            <table>
                <tbody>
                    <tr>
                        <td><i class="fas fa-user"></i></td>
                        <td>{{ Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-at"></i></td>
                        <td>{{ Auth::user()->email}}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user"></i></td>
                        <td>{{ Auth::user()->name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#hometab" role="tab" data-toggle="tab">Home</a></li>
        <li><a href="#javatab" role="tab" data-toggle="tab">Java</a></li>
        <li><a href="#csharptab" role="tab" data-toggle="tab">C#</a></li>
        <li><a href="#mysqltab" role="tab" data-toggle="tab">MySQL</a></li>
        <li><a href="#jquerytab" role="tab" data-toggle="tab">jQuery</a></li>
      </ul>
      </li>
</div>
