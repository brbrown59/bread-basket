
<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->

	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-sm-10">
				<div class="h2-bb">{{ organization.orgName }} </div>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-warning btn-block" ng-click="setEditedOrganization();">Edit</button>
			</div>
		</div>
	</div>
	<hr />
	<!--hours, phone, org description-->
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-phone"></span> Phone</h3>
					<h3>{{ organization.orgPhone }}</h3>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
					<h3>{{ organization.orgHours }}</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<address>
						<strong>{{ organization.orgName }}</strong><br>
						{{ organization.orgAddress1 }}<br>
						{{ organization.orgAddress2 }}<br>
						{{ organization.orgCity }}
						{{ organization.orgState }}<br>
						{{ organization.orgZip }}<br>
					</address>
				</div>
			</div>
		</div>
	</div>
	<!--address-->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pencil"></span> Description</h3>
					<p>{{ organization.orgDescription }}
					</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pushpin"></span> Location</h3>
					<ng-map zoom="16" center="{{ organization.orgAddress1 }} + ' ' + {{ organization.orgAddress2 }} + ' ' + {{ organization.orgCity }} + ', ' + {{ organization.orgState }} + ', ' + {{ organization.orgZip }}" />
					<marker position="{{organization.orgAddress1}} + ' ' + {{organization.orgAddress2}} + ' ' + {{organization.orgCity}} + ', ' + {{organization.orgState}} + ', ' + {{organization.orgZip}}"><marker />
				</div>
			</div>
		</div>
	</div>

