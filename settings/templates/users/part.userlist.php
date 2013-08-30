<?php

/**
 * ownCloud - Core
 *
 * @author Raghu Nayyar
 * @copyright 2013 Raghu Nayyar <raghu.nayyar.007@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
?>
<div ng-controller="userlistController">
	<div id="searchBar">
		<label>Search Users: </label>
		<input type="text" ng-model="search" />
	</div>
	<loading></loading>
	<table id="userlist">
		<thead>
			<tr>
				<!--Do something with the static hmtl here in the view.-->
				<th class="table-head thumbnail"></th>
				<th class="table-head login-name">Username</th>
				<th class="table-head display-name">Display Name</th>
				<th class="table-head user-pass">Password</th>
				<th class="table-head groups">Groups</th>
				<th class="table-head groups">Sub Admin</th>
				<th class="table-head local-storage">Storage</th>
				<th class="table-head user-actions"></th>
			</tr>
		</thead>
		<tbody>
			<!-- The Filter Goes here with the ngRepeat.-->
			<tr ng-repeat="user in users | orderBy:['isAdmin','isSubAdmin','name'] | filter:search"
				ng-init="viewname = true; editname = false;
					 viewdisplayname = true; editdisplayname = false;
					 viewpassword = true; editpassword = false;
					 viewgroup = true; editgroup = false;
					 viewls = true; editls = false;"
				ng-class="{
				 	admin: !user.isAdmin
				 }"
					 >
				<td class="thumbnail">
					<div class="avatardiv"></div>
				</td>
				<td class="login-name">
					<span>{{ user.name }}</span>
				</td>
				<td class="display-name">
					<span ng-show="viewdisplayname"
						ng-click="viewdisplayname = !viewdisplayname; editdisplayname = !editdisplayname;">
						{{ user.displayname }}
					</span>
					<input type="text"
						ng-show="editdisplayname"
						ng-model="user.displayname"
						ng-focus="editdisplayname"
						ng-blur="
							editdisplayname = !editdisplayname;
							viewdisplayname = !viewdisplayname;
							updateDisplayName(user.id, user.displayname)"
					/>
				</td>
				<td class="user-pass">
					<span
						ng-show="viewpassword"
						ng-click="viewpassword = !viewpassword; editpassword = !editpassword">
						●●●●●●●
					</span>
					<input
						type="password"
						ng-show="editpassword"
						ng-model="user.password"
						placeholder="●●●●●●●"
						ng-focus="editpassword"
						ng-blur="
							editpassword = !editpassword;
							viewpassword = !viewpassword;
							updatePassword(user.id,user.password)"
					/>
				</td>
				<td class="groups">
					<select
						class="multiselect"
						data-placeholder="Select Options" 
						ng-model="user.selectedgroup"
						ng-options="pergroup.name for pergroup in allgroups.result"
						multiple="multiple" multiselect-users>
					</select>
				</td>
				<td class="subadmin-groups">
					<select
						class="multiselect"
						data-placeholder="Select Options" 
						ng-model="user.selectedgroup"
						ng-options="pergroup.name for pergroup in allgroups.result"
						multiple="multiple" multiselect-users>
					</select>
				</td>
				<td class="local-storage">
					<span
						ng-show="viewls"
						ng-click="viewls = !viewls; editls = !editls">
							{{ user.quota }}
					</span>
					<select
						ng-show="editls"
						ng-focus="editls"
						ng-blur="editls = !editls; viewls = !viewls">
						<option>Default</option>
						<option>1 GB</option>
						<option>5 GB</option>
						<option>10 GB</option>
						<option>Unlimited..</option>
						<option>Other..</option>
					</select>
				</td>
				<td class="delete-column">
					<button class="svg action delete-icon delete-button delete-user-icon" 
						ng-click="deleteuser(user.name)">
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
