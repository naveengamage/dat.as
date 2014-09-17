<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <script src="//kastatic.com/js/xhr-ee4f1df.js" type="text/javascript"></script>
</head>
<body>


<div class="width700px">
	<h1>Your Settings</h1>
	
	<div class="alertHeightContainer"><div id="requestStatus" class="goodalertfield" style="display:none;"></div></div>
    <script type="text/javascript" charset="utf-8">
		$(function () {
			$('.stabs').tabs({ useHash: false });
		});
	</script>
	<div class="stabs">
		<ul class="tabNavigation">
			<li><a href="#" rel="settings-general" class="darkButton"><span>General</span></a></li>
			<li><a href="#" rel="settings-profile" class="darkButton"><span>profile</span></a></li>
			<li><a href="#" rel="settings-privacy" class="darkButton"><span>privacy</span></a></li>
		</ul>
		<hr class="tabsSeparator" />

		<div id="tab-settings-profile" class="contentTabContainer">
			<form action="/settings/profile/" method="post" class="ajaxFormReload">
				<table border="0" class="formtable">
					<tr> 
						<td>
							@if(!empty(Auth::user()->avatar))
								<img id="userpic" src="/uploads/user/{{Auth::user()->id}}/thumb/{{Auth::user()->avatar}}.png" alt="Userpic" border="0" />
							@else
								<img id="userpic" src="/images/commentlogo.png" alt="Userpic" border="0" />
							@endif
						</td>
						<td>
							<a href="/account/setuserpic/" id="setuserpic" class="siteButton bigButton"><span>change</span></a>
							
							@if(!empty(Auth::user()->avatar))
								<a href="/account/deluserpic/" id="deluserpic" class="siteButton bigButton"><span>remove</span></a>
							@else
								<a href="/account/deluserpic/" id="deluserpic" class="siteButton bigButton" style="display:none" ><span>remove</span></a>
							@endif
						</td>
					</tr>
				</table>
				<hr />
				<table border="0" class="formtable">
					<tr>
						<td class="valignTop nobr width150px"><label>Nickname</label></td>
						<td valign="top"><input type="text" name="nickname" value="navgamd" class="textinput mediuminput" disabled="disabled"/></td> 
					</tr>
					<tr>
						<td>E-mail <span class="red">*</span></td>
						<td><input type="email" name="email" value="naveencgr8@nokiamail.com" class="textinput fullinput"/></td>
					</tr>
					<tr>
						<td colspan=2><div class="font11px lightgrey">A letter with confirmation link will be sent to your old email, please follow the link to confirm your new email. If you can't access your old mailbox, please contact the administration.</div></td>
					</tr>
					<tr>
						<td>Sex</td>
						<td>
							<input type="radio" name="sex" value="m" id="sex_male"/> <label for="sex_male">male</label> &nbsp;
							<input type="radio" name="sex" value="f" id="sex_female"/> <label for="sex_female">female</label> &nbsp;
							<input type="radio" name="sex" value="" id="sex_other" checked="checked"/> <label for="sex_other">other</label> &nbsp;
						</td>
					</tr>
					<tr>
						<td>Birthday</td>
						<td><input type="text" name="birthday" value="" id="birthday" class="textinput fullinput"></td>
					</tr>
					<tr>
						<td>Hash</td>
						<td>
							<input type="text" name="userhash" value="a1342387865d73055f8a6705ffff067d" id="userhash" class="textinput fullinput" disabled="disabled"/>
							<a href="/account/regeneratehash/" id="regeneratehash">Regenerate</a>
						</td>
					</tr>
				</table>
				<hr />
				<table border="0" class="formtable">
					<tr>
						<td class="width150px"><label>Select your country</label></td>
						<td><select class="longinput" class="botpad10px" name="country_code">
								<option value="af">Afghanistan</option>
								<option value="ax">Aland Islands</option>
								<option value="al">Albania</option>
								<option value="dz">Algeria</option>
								<option value="as">American Samoa</option>
								<option value="ad">Andorra</option>
								<option value="ao">Angola</option>
								<option value="ai">Anguilla</option>
								<option value="aq">Antarctica</option>
								<option value="ag">Antigua and Barbuda</option>
								<option value="ar">Argentina</option>
								<option value="am">Armenia</option>
								<option value="aw">Aruba</option>
								<option value="au">Australia</option>
								<option value="at">Austria</option>
								<option value="az">Azerbaijan</option>
								<option value="bs">Bahamas</option>
								<option value="bh">Bahrain</option>
								<option value="bd">Bangladesh</option>
								<option value="bb">Barbados</option>
								<option value="by">Belarus</option>
								<option value="be">Belgium</option>
								<option value="bz">Belize</option>
								<option value="bj">Benin</option>
								<option value="bm">Bermuda</option>
								<option value="bt">Bhutan</option>
								<option value="bo">Bolivia</option>
								<option value="bq">Bonaire</option>
								<option value="ba">Bosnia and Herzegovina</option>
								<option value="bw">Botswana</option>
								<option value="bv">Bouvet Island</option>
								<option value="br">Brazil</option>
								<option value="io">British Indian Ocean Territory</option>
								<option value="bn">Brunei</option>
								<option value="bg">Bulgaria</option>
								<option value="bf">Burkina Faso</option>
								<option value="bi">Burundi</option>
								<option value="kh">Cambodia</option>
								<option value="cm">Cameroon</option>
								<option value="ca">Canada</option>
								<option value="cv">Cape Verde</option>
								<option value="ky">Cayman Islands</option>
								<option value="cf">Central African Republic</option>
								<option value="td">Chad</option>
								<option value="cl">Chile</option>
								<option value="cn">China</option>
								<option value="cx">Christmas Island</option>
								<option value="cc">Cocos (Keeling) Islands</option>
								<option value="co">Colombia</option>
								<option value="km">Comoros</option>
								<option value="cg">Congo</option>
								<option value="cd">Congo, Democractic Republic</option>
								<option value="ck">Cook Islands</option>
								<option value="cr">Costa Rica</option>
								<option value="ci">Cote d'Ivoire</option>
								<option value="hr">Croatia</option>
								<option value="cu">Cuba</option>
								<option value="cw">Curacao</option>
								<option value="cy">Cyprus</option>
								<option value="cz">Czech Republic</option>
								<option value="dk">Denmark</option>
								<option value="dj">Djibouti</option>
								<option value="dm">Dominica</option>
								<option value="do">Dominican Republic</option>
								<option value="ec">Ecuador</option>
								<option value="eg">Egypt</option>
								<option value="sv">El Salvador</option>
								<option value="gq">Equatorial Guinea</option>
								<option value="er">Eritrea</option>
								<option value="ee">Estonia</option>
								<option value="et">Ethiopia</option>
								<option value="eu">European Union</option>
								<option value="fk">Falkland Islands (Malvinas)</option>
								<option value="fo">Faroe Islands</option>
								<option value="fj">Fiji</option>
								<option value="fi">Finland</option>
								<option value="fr">France</option>
								<option value="gf">French Guiana</option>
								<option value="pf">French Polynesia</option>
								<option value="tf">French Southern Territories</option>
								<option value="ga">Gabon</option>
								<option value="gm">Gambia</option>
								<option value="ge">Georgia</option>
								<option value="de">Germany</option>
								<option value="gh">Ghana</option>
								<option value="gi">Gibraltar</option>
								<option value="gr">Hellas</option>
								<option value="gl">Greenland</option>
								<option value="gd">Grenada</option>
								<option value="gp">Guadeloupe</option>
								<option value="gu">Guam</option>
								<option value="gt">Guatemala</option>
								<option value="gg">Guernsey</option>
								<option value="gn">Guinea</option>
								<option value="gw">Guinea-Bissau</option>
								<option value="gy">Guyana</option>
								<option value="ht">Haiti</option>
								<option value="hm">Heard Island and McDonald Islands</option>
								<option value="va">Holy See (Vatican)</option>
								<option value="hn">Honduras</option>
								<option value="hk">Hong Kong</option>
								<option value="hu">Hungary</option>
								<option value="is">Iceland</option>
								<option value="in">India</option>
								<option value="id">Indonesia</option>
								<option value="ir">Iran</option>
								<option value="iq">Iraq</option>
								<option value="ie">Ireland</option>
								<option value="im">Isle of Man</option>
								<option value="il">Israel</option>
								<option value="it">Italy</option>
								<option value="jm">Jamaica</option>
								<option value="jp">Japan</option>
								<option value="je">Jersey</option>
								<option value="jo">Jordan</option>
								<option value="kz">Kazakhstan</option>
								<option value="ke">Kenya</option>
								<option value="ki">Kiribati</option>
								<option value="kr">Korea</option>
								<option value="kp">Korea, Democratic People's Republic</option>
								<option value="kv">Kosovo</option>
								<option value="kw">Kuwait</option>
								<option value="kg">Kyrgyzstan</option>
								<option value="la">Laos</option>
								<option value="lv">Latvia</option>
								<option value="lb">Lebanon</option>
								<option value="ls">Lesotho</option>
								<option value="lr">Liberia</option>
								<option value="ly">Libya</option>
								<option value="li">Liechtenstein</option>
								<option value="lt">Lithuania</option>
								<option value="lu">Luxembourg</option>
								<option value="mo">Macao</option>
								<option value="mk">Macedonia</option>
								<option value="mg">Madagascar</option>
								<option value="mw">Malawi</option>
								<option value="my">Malaysia</option>
								<option value="mv">Maldives</option>
								<option value="ml">Mali</option>
								<option value="mt">Malta</option>
								<option value="mh">Marshall Islands</option>
								<option value="mq">Martinique</option>
								<option value="mr">Mauritania</option>
								<option value="mu">Mauritius</option>
								<option value="yt">Mayotte</option>
								<option value="mx">Mexico</option>
								<option value="fm">Micronesia</option>
								<option value="md">Moldova</option>
								<option value="mc">Monaco</option>
								<option value="mn">Mongolia</option>
								<option value="me">Montenegro</option>
								<option value="ms">Montserrat</option>
								<option value="ma">Morocco</option>
								<option value="mz">Mozambique</option>
								<option value="mm">Myanmar</option>
								<option value="na">Namibia</option>
								<option value="nr">Nauru</option>
								<option value="np">Nepal</option>
								<option value="nl">Netherlands</option>
								<option value="nc">New Caledonia</option>
								<option value="nz" selected="selected">New Zealand</option>
								<option value="ni">Nicaragua</option>
								<option value="ne">Niger</option>
								<option value="ng">Nigeria</option>
								<option value="nu">Niue</option>
								<option value="nf">Norfolk Island</option>
								<option value="mp">Northern Mariana Islands</option>
								<option value="no">Norway</option>
								<option value="om">Oman</option>
								<option value="pk">Pakistan</option>
								<option value="pw">Palau</option>
								<option value="ps">Palestine</option>
								<option value="pa">Panama</option>
								<option value="pg">Papua new Guinea</option>
								<option value="py">Paraguay</option>
								<option value="pe">Peru</option>
								<option value="ph">Philippines</option>
								<option value="pn">Pitcairn</option>
								<option value="pl">Poland</option>
								<option value="pt">Portugal</option>
								<option value="pr">Puerto Rico</option>
								<option value="qa">Qatar</option>
								<option value="re">Reunion</option>
								<option value="ro">Romania</option>
								<option value="ru">Russia</option>
								<option value="rw">Rwanda</option>
								<option value="bl">Saint Barthelemy</option>
								<option value="sh">Saint Helena</option>
								<option value="kn">Saint Kitts and Nevis</option>
								<option value="lc">Saint Lucia</option>
								<option value="mf">Saint Martin (French)</option>
								<option value="pm">Saint Pierre and Miquelon</option>
								<option value="vc">Saint Vincent and The Grenadines</option>
								<option value="ws">Samoa</option>
								<option value="sm">San Marino</option>
								<option value="st">Sao Tome and Principe</option>
								<option value="sa">Saudi Arabia</option>
								<option value="sn">Senegal</option>
								<option value="rs">Serbia</option>
								<option value="sc">Seychelles</option>
								<option value="sl">Sierra Leone</option>
								<option value="sg">Singapore</option>
								<option value="sx">Sint Maarten (Dutch)</option>
								<option value="sk">Slovakia</option>
								<option value="si">Slovenia</option>
								<option value="sb">Solomon Islands</option>
								<option value="so">Somalia</option>
								<option value="za">South Africa</option>
								<option value="gs">South Georgia and The South Sandwich Islands</option>
								<option value="ss">South Sudan</option>
								<option value="es">Spain</option>
								<option value="lk">Sri Lanka</option>
								<option value="sd">Sudan</option>
								<option value="sr">Suriname</option>
								<option value="sj">Svalbard and Jan Mayen</option>
								<option value="sz">Swaziland</option>
								<option value="se">Sweden</option>
								<option value="ch">Switzerland</option>
								<option value="sy">Syria</option>
								<option value="tw">Taiwan</option>
								<option value="tj">Tajikistan</option>
								<option value="tz">Tanzania</option>
								<option value="th">Thailand</option>
								<option value="tl">Timor-Leste</option>
								<option value="tg">Togo</option>
								<option value="tk">Tokelau</option>
								<option value="to">Tonga</option>
								<option value="tt">Trinidad and Tobago</option>
								<option value="tn">Tunisia</option>
								<option value="tr">Turkey</option>
								<option value="tm">Turkmenistan</option>
								<option value="tc">Turks and Caicos Islands</option>
								<option value="tv">Tuvalu</option>
								<option value="ug">Uganda</option>
								<option value="ua">Ukraine</option>
								<option value="ae">United Arab Emirates</option>
								<option value="gb">United Kingdom</option>
								<option value="us">United States</option>
								<option value="um">United States Minor Outlying Islands</option>
								<option value="uy">Uruguay</option>
								<option value="uz">Uzbekistan</option>
								<option value="vu">Vanuatu</option>
								<option value="ve">Venezuela</option>
								<option value="vn">Vietnam</option>
								<option value="vg">Virgin Islands (British)</option>
								<option value="vi">Virgin Islands (U.S.)</option>
								<option value="wf">Wallis and Futuna</option>
								<option value="eh">Western Sahara</option>
								<option value="ye">Yemen</option>
								<option value="zm">Zambia</option>
								<option value="zw">Zimbabwe</option>

						</select></td>
					</tr>
					<tr>
						<td></td>
						<td><label><input type="checkbox" class="checkbox" name="show_country_flag" value="1"/> Show your country location</label></td>
					</tr>
				</table>
				<hr />
				<table border="0" class="formtable">
					<tr>
						<td colspan=2><div class="font11px lightgrey">Enter your password only if you want to change it.</div></td>
					</tr>
					<tr>
						<td class="valignTop nobr width150px"><label>Old password</label></td>
						<td><input type="password" name="old_password" value="" class="textinput fullinput"></td>
					</tr>
					<tr>
						<td class="valignTop nobr width150px"><label>New password</label></td>
						<td><input id="password" type="password" name="password" value="" class="textinput fullinput"></td>
					</tr>
					</table>
					<hr />
					<table border="0" class="formtable">
					<tr>
						<td class="capital valignTop nobr width150px">delete my profile</td>
						<td><a href="#" class="siteButton smallButton redButton" onclick="doomsdayDevice();return false;"><span>Delete</span></a></td>
					</tr>
				</table>
			<hr/>
			<br />
			<div class="buttonsline">
				<a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>        <button type="submit" name="submit" class="siteButton bigButton" id="butsave"><span>save</span></button>
			</div>
		</form>
	</div>
	<div style="display:none">
		<div id="doomdiv">
			<h3>Why do you want to delete your account?</h3>
			<form action="/account/accountdelete/" method="post" accept-charset="utf-8">
				<input type="hidden" name="userhash" value="a1342387865d73055f8a6705ffff067d"/>
				<textarea class="botmarg5px" name="reason" rows="10" cols="60" id="delete_reason"></textarea>
				<div class="buttonsline">
					<a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>
					<button type="submit" class="siteButton bigButton"><span>submit</span></button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	function doomsdayDevice () {
		if (!confirm('Delete your account forever?')) {
			return;
		}
		$.fancybox($("#doomdiv").html());
		// $("#doomdiv").show();
	}
	</script>
	<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" media="screen" charset="utf-8" />
	<script type="text/javascript">
	$(document).ready(function() {
		$("#birthday").datepicker({ dateFormat:'mm/dd/yy', maxDate: '-1Y', changeMonth:true, changeYear:true });
		$('#password').showPassword();
		$("#regeneratehash").click(function() {
			var a = $(this);
			if (confirm('Are you sure that you want to re-generate your hash?')) {
				$.post(a.attr('href'), function(userhash) {
					a.prev().val(userhash);
				});
			}
			return false;
		});
	});
	</script>
	<script type="text/javascript">
	$(function() {
		var cur = $("#userpic"),
			del = $("#deluserpic"),
			set = $("#setuserpic");

		del.click(function() {
			if (confirm('Are you sure that you want to delete current userpic?')) {
				$.fancybox.showActivity();
				$.post($(this).attr('href'), function(data) {
					$.fancybox.hideActivity();
					if (data.method == 'error') {
						alert('error: ' + data.html);
					} else {
						del.fadeOut();
						cur.attr('src', '//kastatic.com/images/commentlogo.png');
					}
				}, 'json').error(function(xhr) {
					$.fancybox.hideActivity();
					alert('ajax error: ' + xhr.responseText);
				});
			}
			return false;
		});

		set.imageSelector({
			select: function(images) {
				$.fancybox.showActivity();
				$.ajax({
					type: "POST",
					url: $(this).attr('href'),
					data: { image_id: images[0].id },
					dataType: "json",
					beforeSend: function(response) {
						cur.attr('src', '//kastatic.com/images/indicator.gif');
					},
					success: function(response) {
						$.fancybox.hideActivity();
						if (response.method == 'error') {
							alert('error: ' + response.html);
						} else {
							cur.attr('src', response.html);
							del.fadeIn();
						}
					},
					error: function(response) {
						$.fancybox.hideActivity();
						alert('ajax error: ' + response.responseText);
					}
				});
			}
		});
	});
	</script>

	<div id="tab-settings-general" class="contentTabContainer">
		<form action="/settings/general/" method="post" class="ajaxFormReload">
			<table border="0" class="formtable">
				<tr>
					<td class="valignTop nobr width150px"><label>Select your timezone</label></td>
					<td><select class="longinput" name="tz" class="botpad10px"><optgroup label="UTC">
							<option value="UTC" selected="selected">07:13 GMT 00:00 UTC</option>
							</optgroup>
							<optgroup label="Africa">
							<option value="Africa/Abidjan">07:13 GMT 00:00 Africa/Abidjan</option>
							<option value="Africa/Bamako">07:13 GMT 00:00 Africa/Bamako</option>
							<option value="Africa/Banjul">07:13 GMT 00:00 Africa/Banjul</option>
							<option value="Africa/Bissau">07:13 GMT 00:00 Africa/Bissau</option>
							<option value="Africa/Casablanca">07:13 GMT 00:00 Africa/Casablanca</option>
							<option value="Africa/Conakry">07:13 GMT 00:00 Africa/Conakry</option>
							<option value="Africa/Dakar">07:13 GMT 00:00 Africa/Dakar</option>
							<option value="Africa/El_Aaiun">07:13 GMT 00:00 Africa/El_Aaiun</option>
							<option value="Africa/Freetown">07:13 GMT 00:00 Africa/Freetown</option>
							<option value="Africa/Lome">07:13 GMT 00:00 Africa/Lome</option>
							<option value="Africa/Monrovia">07:13 GMT 00:00 Africa/Monrovia</option>
							<option value="Africa/Nouakchott">07:13 GMT 00:00 Africa/Nouakchott</option>
							<option value="Africa/Ouagadougou">07:13 GMT 00:00 Africa/Ouagadougou</option>
							<option value="Africa/Sao_Tome">07:13 GMT 00:00 Africa/Sao_Tome</option>
							<option value="Africa/Accra">07:13 GMT 00:00 Africa/Accra</option>
							<option value="Africa/Bangui">08:13 GMT+01:00 Africa/Bangui</option>
							<option value="Africa/Brazzaville">08:13 GMT+01:00 Africa/Brazzaville</option>
							<option value="Africa/Douala">08:13 GMT+01:00 Africa/Douala</option>
							<option value="Africa/Kinshasa">08:13 GMT+01:00 Africa/Kinshasa</option>
							<option value="Africa/Lagos">08:13 GMT+01:00 Africa/Lagos</option>
							<option value="Africa/Libreville">08:13 GMT+01:00 Africa/Libreville</option>
							<option value="Africa/Luanda">08:13 GMT+01:00 Africa/Luanda</option>
							<option value="Africa/Malabo">08:13 GMT+01:00 Africa/Malabo</option>
							<option value="Africa/Ndjamena">08:13 GMT+01:00 Africa/Ndjamena</option>
							<option value="Africa/Niamey">08:13 GMT+01:00 Africa/Niamey</option>
							<option value="Africa/Porto-Novo">08:13 GMT+01:00 Africa/Porto-Novo</option>
							<option value="Africa/Windhoek">08:13 GMT+01:00 Africa/Windhoek</option>
							<option value="Africa/Algiers">08:13 GMT+01:00 Africa/Algiers</option>
							<option value="Africa/Tunis">08:13 GMT+01:00 Africa/Tunis</option>
							<option value="Africa/Blantyre">09:13 GMT+02:00 Africa/Blantyre</option>
							<option value="Africa/Bujumbura">09:13 GMT+02:00 Africa/Bujumbura</option>
							<option value="Africa/Harare">09:13 GMT+02:00 Africa/Harare</option>
							<option value="Africa/Kigali">09:13 GMT+02:00 Africa/Kigali</option>
							<option value="Africa/Lubumbashi">09:13 GMT+02:00 Africa/Lubumbashi</option>
							<option value="Africa/Lusaka">09:13 GMT+02:00 Africa/Lusaka</option>
							<option value="Africa/Maputo">09:13 GMT+02:00 Africa/Maputo</option>
							<option value="Africa/Maseru">09:13 GMT+02:00 Africa/Maseru</option>
							<option value="Africa/Mbabane">09:13 GMT+02:00 Africa/Mbabane</option>
							<option value="Africa/Cairo">09:13 GMT+02:00 Africa/Cairo</option>
							<option value="Africa/Ceuta">09:13 GMT+02:00 Africa/Ceuta</option>
							<option value="Africa/Gaborone">09:13 GMT+02:00 Africa/Gaborone</option>
							<option value="Africa/Johannesburg">09:13 GMT+02:00 Africa/Johannesburg</option>
							<option value="Africa/Tripoli">09:13 GMT+02:00 Africa/Tripoli</option>
							<option value="Africa/Addis_Ababa">10:13 GMT+03:00 Africa/Addis_Ababa</option>
							<option value="Africa/Asmara">10:13 GMT+03:00 Africa/Asmara</option>
							<option value="Africa/Dar_es_Salaam">10:13 GMT+03:00 Africa/Dar_es_Salaam</option>
							<option value="Africa/Djibouti">10:13 GMT+03:00 Africa/Djibouti</option>
							<option value="Africa/Kampala">10:13 GMT+03:00 Africa/Kampala</option>
							<option value="Africa/Mogadishu">10:13 GMT+03:00 Africa/Mogadishu</option>
							<option value="Africa/Nairobi">10:13 GMT+03:00 Africa/Nairobi</option>
							<option value="Africa/Khartoum">10:13 GMT+03:00 Africa/Khartoum</option>
							</optgroup>
							<optgroup label="America">
							<option value="America/Adak">22:13 GMT-09:00 America/Adak</option>
							<option value="America/Anchorage">23:13 GMT-08:00 America/Anchorage</option>
							<option value="America/Juneau">23:13 GMT-08:00 America/Juneau</option>
							<option value="America/Nome">23:13 GMT-08:00 America/Nome</option>
							<option value="America/Yakutat">23:13 GMT-08:00 America/Yakutat</option>
							<option value="America/Dawson_Creek">00:13 GMT-07:00 America/Dawson_Creek</option>
							<option value="America/Hermosillo">00:13 GMT-07:00 America/Hermosillo</option>
							<option value="America/Santa_Isabel">00:13 GMT-07:00 America/Santa_Isabel</option>
							<option value="America/Tijuana">00:13 GMT-07:00 America/Tijuana</option>
							<option value="America/Dawson">00:13 GMT-07:00 America/Dawson</option>
							<option value="America/Los_Angeles">00:13 GMT-07:00 America/Los_Angeles</option>
							<option value="America/Phoenix">00:13 GMT-07:00 America/Phoenix</option>
							<option value="America/Vancouver">00:13 GMT-07:00 America/Vancouver</option>
							<option value="America/Whitehorse">00:13 GMT-07:00 America/Whitehorse</option>
							<option value="America/Edmonton">01:13 GMT-06:00 America/Edmonton</option>
							<option value="America/Mazatlan">01:13 GMT-06:00 America/Mazatlan</option>
							<option value="America/Regina">01:13 GMT-06:00 America/Regina</option>
							<option value="America/Swift_Current">01:13 GMT-06:00 America/Swift_Current</option>
							<option value="America/Belize">01:13 GMT-06:00 America/Belize</option>
							<option value="America/Boise">01:13 GMT-06:00 America/Boise</option>
							<option value="America/Cambridge_Bay">01:13 GMT-06:00 America/Cambridge_Bay</option>
							<option value="America/Chihuahua">01:13 GMT-06:00 America/Chihuahua</option>
							<option value="America/Costa_Rica">01:13 GMT-06:00 America/Costa_Rica</option>
							<option value="America/Denver">01:13 GMT-06:00 America/Denver</option>
							<option value="America/El_Salvador">01:13 GMT-06:00 America/El_Salvador</option>
							<option value="America/Guatemala">01:13 GMT-06:00 America/Guatemala</option>
							<option value="America/Inuvik">01:13 GMT-06:00 America/Inuvik</option>
							<option value="America/Managua">01:13 GMT-06:00 America/Managua</option>
							<option value="America/Ojinaga">01:13 GMT-06:00 America/Ojinaga</option>
							<option value="America/Tegucigalpa">01:13 GMT-06:00 America/Tegucigalpa</option>
							<option value="America/Yellowknife">01:13 GMT-06:00 America/Yellowknife</option>
							<option value="America/Bogota">02:13 GMT-05:00 America/Bogota</option>
							<option value="America/Cayman">02:13 GMT-05:00 America/Cayman</option>
							<option value="America/Guayaquil">02:13 GMT-05:00 America/Guayaquil</option>
							<option value="America/Lima">02:13 GMT-05:00 America/Lima</option>
							<option value="America/Panama">02:13 GMT-05:00 America/Panama</option>
							<option value="America/Atikokan">02:13 GMT-05:00 America/Atikokan</option>
							<option value="America/Bahia_Banderas">02:13 GMT-05:00 America/Bahia_Banderas</option>
							<option value="America/Cancun">02:13 GMT-05:00 America/Cancun</option>
							<option value="America/Chicago">02:13 GMT-05:00 America/Chicago</option>
							<option value="America/Eirunepe">02:13 GMT-05:00 America/Eirunepe</option>
							<option value="America/Indiana/Knox">02:13 GMT-05:00 America/Indiana/Knox</option>
							<option value="America/Indiana/Tell_City">02:13 GMT-05:00 America/Indiana/Tell_City</option>
							<option value="America/Jamaica">02:13 GMT-05:00 America/Jamaica</option>
							<option value="America/Matamoros">02:13 GMT-05:00 America/Matamoros</option>
							<option value="America/Menominee">02:13 GMT-05:00 America/Menominee</option>
							<option value="America/Merida">02:13 GMT-05:00 America/Merida</option>
							<option value="America/Mexico_City">02:13 GMT-05:00 America/Mexico_City</option>
							<option value="America/Monterrey">02:13 GMT-05:00 America/Monterrey</option>
							<option value="America/North_Dakota/Center">02:13 GMT-05:00 America/North_Dakota/Center</option>
							<option value="America/North_Dakota/New_Salem">02:13 GMT-05:00 America/North_Dakota/New_Salem</option>
							<option value="America/Rainy_River">02:13 GMT-05:00 America/Rainy_River</option>
							<option value="America/Rankin_Inlet">02:13 GMT-05:00 America/Rankin_Inlet</option>
							<option value="America/Resolute">02:13 GMT-05:00 America/Resolute</option>
							<option value="America/Rio_Branco">02:13 GMT-05:00 America/Rio_Branco</option>
							<option value="America/Winnipeg">02:13 GMT-05:00 America/Winnipeg</option>
							<option value="America/Caracas">02:43 GMT-04:30 America/Caracas</option>
							<option value="America/Anguilla">03:13 GMT-04:00 America/Anguilla</option>
							<option value="America/Antigua">03:13 GMT-04:00 America/Antigua</option>
							<option value="America/Aruba">03:13 GMT-04:00 America/Aruba</option>
							<option value="America/Asuncion">03:13 GMT-04:00 America/Asuncion</option>
							<option value="America/Curacao">03:13 GMT-04:00 America/Curacao</option>
							<option value="America/Detroit">03:13 GMT-04:00 America/Detroit</option>
							<option value="America/Dominica">03:13 GMT-04:00 America/Dominica</option>
							<option value="America/Grenada">03:13 GMT-04:00 America/Grenada</option>
							<option value="America/Guadeloupe">03:13 GMT-04:00 America/Guadeloupe</option>
							<option value="America/Guyana">03:13 GMT-04:00 America/Guyana</option>
							<option value="America/Marigot">03:13 GMT-04:00 America/Marigot</option>
							<option value="America/Montserrat">03:13 GMT-04:00 America/Montserrat</option>
							<option value="America/Port_of_Spain">03:13 GMT-04:00 America/Port_of_Spain</option>
							<option value="America/Santo_Domingo">03:13 GMT-04:00 America/Santo_Domingo</option>
							<option value="America/St_Barthelemy">03:13 GMT-04:00 America/St_Barthelemy</option>
							<option value="America/St_Kitts">03:13 GMT-04:00 America/St_Kitts</option>
							<option value="America/St_Lucia">03:13 GMT-04:00 America/St_Lucia</option>
							<option value="America/St_Thomas">03:13 GMT-04:00 America/St_Thomas</option>
							<option value="America/St_Vincent">03:13 GMT-04:00 America/St_Vincent</option>
							<option value="America/Thunder_Bay">03:13 GMT-04:00 America/Thunder_Bay</option>
							<option value="America/Tortola">03:13 GMT-04:00 America/Tortola</option>
							<option value="America/Barbados">03:13 GMT-04:00 America/Barbados</option>
							<option value="America/Blanc-Sablon">03:13 GMT-04:00 America/Blanc-Sablon</option>
							<option value="America/Boa_Vista">03:13 GMT-04:00 America/Boa_Vista</option>
							<option value="America/Campo_Grande">03:13 GMT-04:00 America/Campo_Grande</option>
							<option value="America/Cuiaba">03:13 GMT-04:00 America/Cuiaba</option>
							<option value="America/Grand_Turk">03:13 GMT-04:00 America/Grand_Turk</option>
							<option value="America/Havana">03:13 GMT-04:00 America/Havana</option>
							<option value="America/Indiana/Indianapolis">03:13 GMT-04:00 America/Indiana/Indianapolis</option>
							<option value="America/Indiana/Marengo">03:13 GMT-04:00 America/Indiana/Marengo</option>
							<option value="America/Indiana/Petersburg">03:13 GMT-04:00 America/Indiana/Petersburg</option>
							<option value="America/Indiana/Vevay">03:13 GMT-04:00 America/Indiana/Vevay</option>
							<option value="America/Indiana/Vincennes">03:13 GMT-04:00 America/Indiana/Vincennes</option>
							<option value="America/Indiana/Winamac">03:13 GMT-04:00 America/Indiana/Winamac</option>
							<option value="America/Iqaluit">03:13 GMT-04:00 America/Iqaluit</option>
							<option value="America/Kentucky/Louisville">03:13 GMT-04:00 America/Kentucky/Louisville</option>
							<option value="America/Kentucky/Monticello">03:13 GMT-04:00 America/Kentucky/Monticello</option>
							<option value="America/La_Paz">03:13 GMT-04:00 America/La_Paz</option>
							<option value="America/Manaus">03:13 GMT-04:00 America/Manaus</option>
							<option value="America/Martinique">03:13 GMT-04:00 America/Martinique</option>
							<option value="America/Nassau">03:13 GMT-04:00 America/Nassau</option>
							<option value="America/New_York">03:13 GMT-04:00 America/New_York</option>
							<option value="America/Nipigon">03:13 GMT-04:00 America/Nipigon</option>
							<option value="America/Pangnirtung">03:13 GMT-04:00 America/Pangnirtung</option>
							<option value="America/Port-au-Prince">03:13 GMT-04:00 America/Port-au-Prince</option>
							<option value="America/Porto_Velho">03:13 GMT-04:00 America/Porto_Velho</option>
							<option value="America/Puerto_Rico">03:13 GMT-04:00 America/Puerto_Rico</option>
							<option value="America/Santiago">03:13 GMT-04:00 America/Santiago</option>
							<option value="America/Toronto">03:13 GMT-04:00 America/Toronto</option>
							<option value="America/Cayenne">04:13 GMT-03:00 America/Cayenne</option>
							<option value="America/Montevideo">04:13 GMT-03:00 America/Montevideo</option>
							<option value="America/Paramaribo">04:13 GMT-03:00 America/Paramaribo</option>
							<option value="America/Araguaina">04:13 GMT-03:00 America/Araguaina</option>
							<option value="America/Argentina/Buenos_Aires">04:13 GMT-03:00 America/Argentina/Buenos_Aires</option>
							<option value="America/Argentina/Catamarca">04:13 GMT-03:00 America/Argentina/Catamarca</option>
							<option value="America/Argentina/Cordoba">04:13 GMT-03:00 America/Argentina/Cordoba</option>
							<option value="America/Argentina/Jujuy">04:13 GMT-03:00 America/Argentina/Jujuy</option>
							<option value="America/Argentina/La_Rioja">04:13 GMT-03:00 America/Argentina/La_Rioja</option>
							<option value="America/Argentina/Mendoza">04:13 GMT-03:00 America/Argentina/Mendoza</option>
							<option value="America/Argentina/Rio_Gallegos">04:13 GMT-03:00 America/Argentina/Rio_Gallegos</option>
							<option value="America/Argentina/Salta">04:13 GMT-03:00 America/Argentina/Salta</option>
							<option value="America/Argentina/San_Juan">04:13 GMT-03:00 America/Argentina/San_Juan</option>
							<option value="America/Argentina/San_Luis">04:13 GMT-03:00 America/Argentina/San_Luis</option>
							<option value="America/Argentina/Tucuman">04:13 GMT-03:00 America/Argentina/Tucuman</option>
							<option value="America/Argentina/Ushuaia">04:13 GMT-03:00 America/Argentina/Ushuaia</option>
							<option value="America/Bahia">04:13 GMT-03:00 America/Bahia</option>
							<option value="America/Belem">04:13 GMT-03:00 America/Belem</option>
							<option value="America/Fortaleza">04:13 GMT-03:00 America/Fortaleza</option>
							<option value="America/Glace_Bay">04:13 GMT-03:00 America/Glace_Bay</option>
							<option value="America/Goose_Bay">04:13 GMT-03:00 America/Goose_Bay</option>
							<option value="America/Halifax">04:13 GMT-03:00 America/Halifax</option>
							<option value="America/Maceio">04:13 GMT-03:00 America/Maceio</option>
							<option value="America/Moncton">04:13 GMT-03:00 America/Moncton</option>
							<option value="America/Recife">04:13 GMT-03:00 America/Recife</option>
							<option value="America/Santarem">04:13 GMT-03:00 America/Santarem</option>
							<option value="America/Sao_Paulo">04:13 GMT-03:00 America/Sao_Paulo</option>
							<option value="America/Thule">04:13 GMT-03:00 America/Thule</option>
							<option value="America/St_Johns">04:43 GMT-02:30 America/St_Johns</option>
							<option value="America/Godthab">05:13 GMT-02:00 America/Godthab</option>
							<option value="America/Miquelon">05:13 GMT-02:00 America/Miquelon</option>
							<option value="America/Noronha">05:13 GMT-02:00 America/Noronha</option>
							<option value="America/Danmarkshavn">07:13 GMT 00:00 America/Danmarkshavn</option>
							<option value="America/Scoresbysund">07:13 GMT 00:00 America/Scoresbysund</option>
							</optgroup>
							<optgroup label="Antarctica">
							<option value="Antarctica/Palmer">03:13 GMT-04:00 Antarctica/Palmer</option>
							<option value="Antarctica/Rothera">04:13 GMT-03:00 Antarctica/Rothera</option>
							<option value="Antarctica/Syowa">10:13 GMT+03:00 Antarctica/Syowa</option>
							<option value="Antarctica/Mawson">12:13 GMT+05:00 Antarctica/Mawson</option>
							<option value="Antarctica/Vostok">13:13 GMT+06:00 Antarctica/Vostok</option>
							<option value="Antarctica/Davis">14:13 GMT+07:00 Antarctica/Davis</option>
							<option value="Antarctica/Casey">15:13 GMT+08:00 Antarctica/Casey</option>
							<option value="Antarctica/DumontDUrville">17:13 GMT+10:00 Antarctica/DumontDUrville</option>
							<option value="Antarctica/Macquarie">18:13 GMT+11:00 Antarctica/Macquarie</option>
							<option value="Antarctica/McMurdo">19:13 GMT+12:00 Antarctica/McMurdo</option>
							</optgroup>
							<optgroup label="Arctic">
							<option value="Arctic/Longyearbyen">09:13 GMT+02:00 Arctic/Longyearbyen</option>
							</optgroup>
							<optgroup label="Asia">
							<option value="Asia/Aden">10:13 GMT+03:00 Asia/Aden</option>
							<option value="Asia/Bahrain">10:13 GMT+03:00 Asia/Bahrain</option>
							<option value="Asia/Kuwait">10:13 GMT+03:00 Asia/Kuwait</option>
							<option value="Asia/Qatar">10:13 GMT+03:00 Asia/Qatar</option>
							<option value="Asia/Riyadh">10:13 GMT+03:00 Asia/Riyadh</option>
							<option value="Asia/Amman">10:13 GMT+03:00 Asia/Amman</option>
							<option value="Asia/Baghdad">10:13 GMT+03:00 Asia/Baghdad</option>
							<option value="Asia/Beirut">10:13 GMT+03:00 Asia/Beirut</option>
							<option value="Asia/Damascus">10:13 GMT+03:00 Asia/Damascus</option>
							<option value="Asia/Gaza">10:13 GMT+03:00 Asia/Gaza</option>
							<option value="Asia/Jerusalem">10:13 GMT+03:00 Asia/Jerusalem</option>
							<option value="Asia/Nicosia">10:13 GMT+03:00 Asia/Nicosia</option>
							<option value="Asia/Dubai">11:13 GMT+04:00 Asia/Dubai</option>
							<option value="Asia/Muscat">11:13 GMT+04:00 Asia/Muscat</option>
							<option value="Asia/Tbilisi">11:13 GMT+04:00 Asia/Tbilisi</option>
							<option value="Asia/Yerevan">11:13 GMT+04:00 Asia/Yerevan</option>
							<option value="Asia/Kabul">11:43 GMT+04:30 Asia/Kabul</option>
							<option value="Asia/Tehran">11:43 GMT+04:30 Asia/Tehran</option>
							<option value="Asia/Karachi">12:13 GMT+05:00 Asia/Karachi</option>
							<option value="Asia/Oral">12:13 GMT+05:00 Asia/Oral</option>
							<option value="Asia/Samarkand">12:13 GMT+05:00 Asia/Samarkand</option>
							<option value="Asia/Tashkent">12:13 GMT+05:00 Asia/Tashkent</option>
							<option value="Asia/Aqtau">12:13 GMT+05:00 Asia/Aqtau</option>
							<option value="Asia/Aqtobe">12:13 GMT+05:00 Asia/Aqtobe</option>
							<option value="Asia/Ashgabat">12:13 GMT+05:00 Asia/Ashgabat</option>
							<option value="Asia/Baku">12:13 GMT+05:00 Asia/Baku</option>
							<option value="Asia/Dushanbe">12:13 GMT+05:00 Asia/Dushanbe</option>
							<option value="Asia/Kolkata">12:43 GMT+05:30 Asia/Kolkata</option>
							<option value="Asia/Colombo">12:43 GMT+05:30 Asia/Colombo</option>
							<option value="Asia/Kathmandu">12:58 GMT+05:45 Asia/Kathmandu</option>
							<option value="Asia/Thimphu">13:13 GMT+06:00 Asia/Thimphu</option>
							<option value="Asia/Yekaterinburg">13:13 GMT+06:00 Asia/Yekaterinburg</option>
							<option value="Asia/Almaty">13:13 GMT+06:00 Asia/Almaty</option>
							<option value="Asia/Bishkek">13:13 GMT+06:00 Asia/Bishkek</option>
							<option value="Asia/Dhaka">13:13 GMT+06:00 Asia/Dhaka</option>
							<option value="Asia/Qyzylorda">13:13 GMT+06:00 Asia/Qyzylorda</option>
							<option value="Asia/Rangoon">13:43 GMT+06:30 Asia/Rangoon</option>
							<option value="Asia/Bangkok">14:13 GMT+07:00 Asia/Bangkok</option>
							<option value="Asia/Ho_Chi_Minh">14:13 GMT+07:00 Asia/Ho_Chi_Minh</option>
							<option value="Asia/Jakarta">14:13 GMT+07:00 Asia/Jakarta</option>
							<option value="Asia/Novosibirsk">14:13 GMT+07:00 Asia/Novosibirsk</option>
							<option value="Asia/Omsk">14:13 GMT+07:00 Asia/Omsk</option>
							<option value="Asia/Phnom_Penh">14:13 GMT+07:00 Asia/Phnom_Penh</option>
							<option value="Asia/Pontianak">14:13 GMT+07:00 Asia/Pontianak</option>
							<option value="Asia/Vientiane">14:13 GMT+07:00 Asia/Vientiane</option>
							<option value="Asia/Hovd">14:13 GMT+07:00 Asia/Hovd</option>
							<option value="Asia/Novokuznetsk">14:13 GMT+07:00 Asia/Novokuznetsk</option>
							<option value="Asia/Brunei">15:13 GMT+08:00 Asia/Brunei</option>
							<option value="Asia/Kuala_Lumpur">15:13 GMT+08:00 Asia/Kuala_Lumpur</option>
							<option value="Asia/Macau">15:13 GMT+08:00 Asia/Macau</option>
							<option value="Asia/Makassar">15:13 GMT+08:00 Asia/Makassar</option>
							<option value="Asia/Manila">15:13 GMT+08:00 Asia/Manila</option>
							<option value="Asia/Singapore">15:13 GMT+08:00 Asia/Singapore</option>
							<option value="Asia/Ulaanbaatar">15:13 GMT+08:00 Asia/Ulaanbaatar</option>
							<option value="Asia/Choibalsan">15:13 GMT+08:00 Asia/Choibalsan</option>
							<option value="Asia/Chongqing">15:13 GMT+08:00 Asia/Chongqing</option>
							<option value="Asia/Harbin">15:13 GMT+08:00 Asia/Harbin</option>
							<option value="Asia/Hong_Kong">15:13 GMT+08:00 Asia/Hong_Kong</option>
							<option value="Asia/Kashgar">15:13 GMT+08:00 Asia/Kashgar</option>
							<option value="Asia/Krasnoyarsk">15:13 GMT+08:00 Asia/Krasnoyarsk</option>
							<option value="Asia/Kuching">15:13 GMT+08:00 Asia/Kuching</option>
							<option value="Asia/Shanghai">15:13 GMT+08:00 Asia/Shanghai</option>
							<option value="Asia/Taipei">15:13 GMT+08:00 Asia/Taipei</option>
							<option value="Asia/Urumqi">15:13 GMT+08:00 Asia/Urumqi</option>
							<option value="Asia/Dili">16:13 GMT+09:00 Asia/Dili</option>
							<option value="Asia/Irkutsk">16:13 GMT+09:00 Asia/Irkutsk</option>
							<option value="Asia/Jayapura">16:13 GMT+09:00 Asia/Jayapura</option>
							<option value="Asia/Pyongyang">16:13 GMT+09:00 Asia/Pyongyang</option>
							<option value="Asia/Tokyo">16:13 GMT+09:00 Asia/Tokyo</option>
							<option value="Asia/Seoul">16:13 GMT+09:00 Asia/Seoul</option>
							<option value="Asia/Yakutsk">17:13 GMT+10:00 Asia/Yakutsk</option>
							<option value="Asia/Sakhalin">18:13 GMT+11:00 Asia/Sakhalin</option>
							<option value="Asia/Vladivostok">18:13 GMT+11:00 Asia/Vladivostok</option>
							<option value="Asia/Kamchatka">19:13 GMT+12:00 Asia/Kamchatka</option>
							<option value="Asia/Magadan">19:13 GMT+12:00 Asia/Magadan</option>
							<option value="Asia/Anadyr">19:13 GMT+12:00 Asia/Anadyr</option>
							</optgroup>
							<optgroup label="Atlantic">
							<option value="Atlantic/Bermuda">04:13 GMT-03:00 Atlantic/Bermuda</option>
							<option value="Atlantic/Stanley">04:13 GMT-03:00 Atlantic/Stanley</option>
							<option value="Atlantic/South_Georgia">05:13 GMT-02:00 Atlantic/South_Georgia</option>
							<option value="Atlantic/Cape_Verde">06:13 GMT-01:00 Atlantic/Cape_Verde</option>
							<option value="Atlantic/Reykjavik">07:13 GMT 00:00 Atlantic/Reykjavik</option>
							<option value="Atlantic/St_Helena">07:13 GMT 00:00 Atlantic/St_Helena</option>
							<option value="Atlantic/Azores">07:13 GMT 00:00 Atlantic/Azores</option>
							<option value="Atlantic/Canary">08:13 GMT+01:00 Atlantic/Canary</option>
							<option value="Atlantic/Faroe">08:13 GMT+01:00 Atlantic/Faroe</option>
							<option value="Atlantic/Madeira">08:13 GMT+01:00 Atlantic/Madeira</option>
							</optgroup>
							<optgroup label="Australia">
							<option value="Australia/Perth">15:13 GMT+08:00 Australia/Perth</option>
							<option value="Australia/Eucla">15:58 GMT+08:45 Australia/Eucla</option>
							<option value="Australia/Adelaide">16:43 GMT+09:30 Australia/Adelaide</option>
							<option value="Australia/Broken_Hill">16:43 GMT+09:30 Australia/Broken_Hill</option>
							<option value="Australia/Darwin">16:43 GMT+09:30 Australia/Darwin</option>
							<option value="Australia/Brisbane">17:13 GMT+10:00 Australia/Brisbane</option>
							<option value="Australia/Currie">17:13 GMT+10:00 Australia/Currie</option>
							<option value="Australia/Hobart">17:13 GMT+10:00 Australia/Hobart</option>
							<option value="Australia/Lindeman">17:13 GMT+10:00 Australia/Lindeman</option>
							<option value="Australia/Melbourne">17:13 GMT+10:00 Australia/Melbourne</option>
							<option value="Australia/Sydney">17:13 GMT+10:00 Australia/Sydney</option>
							<option value="Australia/Lord_Howe">17:43 GMT+10:30 Australia/Lord_Howe</option>
							</optgroup>
							<optgroup label="Europe">
							<option value="Europe/Dublin">08:13 GMT+01:00 Europe/Dublin</option>
							<option value="Europe/Guernsey">08:13 GMT+01:00 Europe/Guernsey</option>
							<option value="Europe/Isle_of_Man">08:13 GMT+01:00 Europe/Isle_of_Man</option>
							<option value="Europe/Jersey">08:13 GMT+01:00 Europe/Jersey</option>
							<option value="Europe/Lisbon">08:13 GMT+01:00 Europe/Lisbon</option>
							<option value="Europe/London">08:13 GMT+01:00 Europe/London</option>
							<option value="Europe/Amsterdam">09:13 GMT+02:00 Europe/Amsterdam</option>
							<option value="Europe/Andorra">09:13 GMT+02:00 Europe/Andorra</option>
							<option value="Europe/Belgrade">09:13 GMT+02:00 Europe/Belgrade</option>
							<option value="Europe/Berlin">09:13 GMT+02:00 Europe/Berlin</option>
							<option value="Europe/Bratislava">09:13 GMT+02:00 Europe/Bratislava</option>
							<option value="Europe/Brussels">09:13 GMT+02:00 Europe/Brussels</option>
							<option value="Europe/Budapest">09:13 GMT+02:00 Europe/Budapest</option>
							<option value="Europe/Copenhagen">09:13 GMT+02:00 Europe/Copenhagen</option>
							<option value="Europe/Gibraltar">09:13 GMT+02:00 Europe/Gibraltar</option>
							<option value="Europe/Ljubljana">09:13 GMT+02:00 Europe/Ljubljana</option>
							<option value="Europe/Luxembourg">09:13 GMT+02:00 Europe/Luxembourg</option>
							<option value="Europe/Madrid">09:13 GMT+02:00 Europe/Madrid</option>
							<option value="Europe/Malta">09:13 GMT+02:00 Europe/Malta</option>
							<option value="Europe/Monaco">09:13 GMT+02:00 Europe/Monaco</option>
							<option value="Europe/Oslo">09:13 GMT+02:00 Europe/Oslo</option>
							<option value="Europe/Paris">09:13 GMT+02:00 Europe/Paris</option>
							<option value="Europe/Podgorica">09:13 GMT+02:00 Europe/Podgorica</option>
							<option value="Europe/Prague">09:13 GMT+02:00 Europe/Prague</option>
							<option value="Europe/Rome">09:13 GMT+02:00 Europe/Rome</option>
							<option value="Europe/San_Marino">09:13 GMT+02:00 Europe/San_Marino</option>
							<option value="Europe/Sarajevo">09:13 GMT+02:00 Europe/Sarajevo</option>
							<option value="Europe/Skopje">09:13 GMT+02:00 Europe/Skopje</option>
							<option value="Europe/Stockholm">09:13 GMT+02:00 Europe/Stockholm</option>
							<option value="Europe/Tirane">09:13 GMT+02:00 Europe/Tirane</option>
							<option value="Europe/Vaduz">09:13 GMT+02:00 Europe/Vaduz</option>
							<option value="Europe/Vatican">09:13 GMT+02:00 Europe/Vatican</option>
							<option value="Europe/Vienna">09:13 GMT+02:00 Europe/Vienna</option>
							<option value="Europe/Warsaw">09:13 GMT+02:00 Europe/Warsaw</option>
							<option value="Europe/Zagreb">09:13 GMT+02:00 Europe/Zagreb</option>
							<option value="Europe/Zurich">09:13 GMT+02:00 Europe/Zurich</option>
							<option value="Europe/Athens">10:13 GMT+03:00 Europe/Athens</option>
							<option value="Europe/Bucharest">10:13 GMT+03:00 Europe/Bucharest</option>
							<option value="Europe/Chisinau">10:13 GMT+03:00 Europe/Chisinau</option>
							<option value="Europe/Helsinki">10:13 GMT+03:00 Europe/Helsinki</option>
							<option value="Europe/Istanbul">10:13 GMT+03:00 Europe/Istanbul</option>
							<option value="Europe/Kaliningrad">10:13 GMT+03:00 Europe/Kaliningrad</option>
							<option value="Europe/Kiev">10:13 GMT+03:00 Europe/Kiev</option>
							<option value="Europe/Mariehamn">10:13 GMT+03:00 Europe/Mariehamn</option>
							<option value="Europe/Minsk">10:13 GMT+03:00 Europe/Minsk</option>
							<option value="Europe/Riga">10:13 GMT+03:00 Europe/Riga</option>
							<option value="Europe/Sofia">10:13 GMT+03:00 Europe/Sofia</option>
							<option value="Europe/Tallinn">10:13 GMT+03:00 Europe/Tallinn</option>
							<option value="Europe/Uzhgorod">10:13 GMT+03:00 Europe/Uzhgorod</option>
							<option value="Europe/Vilnius">10:13 GMT+03:00 Europe/Vilnius</option>
							<option value="Europe/Zaporozhye">10:13 GMT+03:00 Europe/Zaporozhye</option>
							<option value="Europe/Volgograd">11:13 GMT+04:00 Europe/Volgograd</option>
							<option value="Europe/Moscow">11:13 GMT+04:00 Europe/Moscow</option>
							<option value="Europe/Samara">11:13 GMT+04:00 Europe/Samara</option>
							<option value="Europe/Simferopol">11:13 GMT+04:00 Europe/Simferopol</option>
							</optgroup>
							<optgroup label="Indian">
							<option value="Indian/Comoro">10:13 GMT+03:00 Indian/Comoro</option>
							<option value="Indian/Mayotte">10:13 GMT+03:00 Indian/Mayotte</option>
							<option value="Indian/Antananarivo">10:13 GMT+03:00 Indian/Antananarivo</option>
							<option value="Indian/Mahe">11:13 GMT+04:00 Indian/Mahe</option>
							<option value="Indian/Mauritius">11:13 GMT+04:00 Indian/Mauritius</option>
							<option value="Indian/Reunion">11:13 GMT+04:00 Indian/Reunion</option>
							<option value="Indian/Kerguelen">12:13 GMT+05:00 Indian/Kerguelen</option>
							<option value="Indian/Maldives">12:13 GMT+05:00 Indian/Maldives</option>
							<option value="Indian/Chagos">13:13 GMT+06:00 Indian/Chagos</option>
							<option value="Indian/Cocos">13:43 GMT+06:30 Indian/Cocos</option>
							<option value="Indian/Christmas">14:13 GMT+07:00 Indian/Christmas</option>
							</optgroup>
							<optgroup label="Pacific">
							<option value="Pacific/Midway">20:13 GMT-11:00 Pacific/Midway</option>
							<option value="Pacific/Niue">20:13 GMT-11:00 Pacific/Niue</option>
							<option value="Pacific/Pago_Pago">20:13 GMT-11:00 Pacific/Pago_Pago</option>
							<option value="Pacific/Johnston">21:13 GMT-10:00 Pacific/Johnston</option>
							<option value="Pacific/Tahiti">21:13 GMT-10:00 Pacific/Tahiti</option>
							<option value="Pacific/Honolulu">21:13 GMT-10:00 Pacific/Honolulu</option>
							<option value="Pacific/Rarotonga">21:13 GMT-10:00 Pacific/Rarotonga</option>
							<option value="Pacific/Marquesas">21:43 GMT-09:30 Pacific/Marquesas</option>
							<option value="Pacific/Gambier">22:13 GMT-09:00 Pacific/Gambier</option>
							<option value="Pacific/Pitcairn">23:13 GMT-08:00 Pacific/Pitcairn</option>
							<option value="Pacific/Galapagos">01:13 GMT-06:00 Pacific/Galapagos</option>
							<option value="Pacific/Easter">01:13 GMT-06:00 Pacific/Easter</option>
							<option value="Pacific/Palau">16:13 GMT+09:00 Pacific/Palau</option>
							<option value="Pacific/Chuuk">17:13 GMT+10:00 Pacific/Chuuk</option>
							<option value="Pacific/Guam">17:13 GMT+10:00 Pacific/Guam</option>
							<option value="Pacific/Port_Moresby">17:13 GMT+10:00 Pacific/Port_Moresby</option>
							<option value="Pacific/Saipan">17:13 GMT+10:00 Pacific/Saipan</option>
							<option value="Pacific/Efate">18:13 GMT+11:00 Pacific/Efate</option>
							<option value="Pacific/Guadalcanal">18:13 GMT+11:00 Pacific/Guadalcanal</option>
							<option value="Pacific/Kosrae">18:13 GMT+11:00 Pacific/Kosrae</option>
							<option value="Pacific/Noumea">18:13 GMT+11:00 Pacific/Noumea</option>
							<option value="Pacific/Pohnpei">18:13 GMT+11:00 Pacific/Pohnpei</option>
							<option value="Pacific/Norfolk">18:43 GMT+11:30 Pacific/Norfolk</option>
							<option value="Pacific/Funafuti">19:13 GMT+12:00 Pacific/Funafuti</option>
							<option value="Pacific/Kwajalein">19:13 GMT+12:00 Pacific/Kwajalein</option>
							<option value="Pacific/Majuro">19:13 GMT+12:00 Pacific/Majuro</option>
							<option value="Pacific/Nauru">19:13 GMT+12:00 Pacific/Nauru</option>
							<option value="Pacific/Tarawa">19:13 GMT+12:00 Pacific/Tarawa</option>
							<option value="Pacific/Wake">19:13 GMT+12:00 Pacific/Wake</option>
							<option value="Pacific/Wallis">19:13 GMT+12:00 Pacific/Wallis</option>
							<option value="Pacific/Auckland">19:13 GMT+12:00 Pacific/Auckland</option>
							<option value="Pacific/Fiji">19:13 GMT+12:00 Pacific/Fiji</option>
							<option value="Pacific/Chatham">19:58 GMT+12:45 Pacific/Chatham</option>
							<option value="Pacific/Apia">20:13 GMT+13:00 Pacific/Apia</option>
							<option value="Pacific/Enderbury">20:13 GMT+13:00 Pacific/Enderbury</option>
							<option value="Pacific/Fakaofo">20:13 GMT+13:00 Pacific/Fakaofo</option>
							<option value="Pacific/Tongatapu">20:13 GMT+13:00 Pacific/Tongatapu</option>
							<option value="Pacific/Kiritimati">21:13 GMT+14:00 Pacific/Kiritimati</option>
							</optgroup>
							</select>
					<div class="font11px lightgrey">If you don't have your timezone set, you won't be able to get some of the achievements.</div></td> 
				</tr>
			</table>
			<hr />
			<table>
				<tr>
					<td class="width150px"></td>
					<td><label><input type="checkbox" class="checkbox" name="show_tagcloud" value="1" checked="checked"/> Show tagcloud on the frontpage</label></td>
				</tr>
				<tr>
					<td></td>			
					<td><label><input type="checkbox" class="checkbox" name="show_signatures" value="1" checked="checked"/> Show user signatures</label></td>			
				</tr>
				<tr>
					<td></td>			
					<td><label><input type="checkbox" class="checkbox" name="hide_recent_search" value="1" checked="checked"/> Hide recent searches</label></td>			
				</tr>
				<tr>
					<td></td>
					<td><label><input type="checkbox" class="checkbox" name="hide_anonymous" value="1"/> Hide Anonymous comments</label></td>			
				</tr>
				<tr>
					<td></td>
					<td><label><input type="checkbox" class="checkbox" name="disable_sounds" value="1"/> Disable message and notification sounds</label></td>
				</tr>
				<tr>
					<td></td>
					<td><label><input type="checkbox" class="checkbox" name="disable_notifications" value="1"/> Disable replies notifications</label></td>
				</tr>
				<tr>
					<td></td>
					<td><label><input type="checkbox" class="checkbox" onchange="$.cookie('disable_animated_upics', $(this).is(':checked')?'yes':'no', { expires: 365, path: '/' });" value="1"/> Disable animated userpics</label></td>
				</tr>
			</table>
			<br />
				<div class="buttonsline">
					<a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>			    <button type="submit" name="submit" class="siteButton bigButton" id="butsave"><span>save</span></button>
				</div>
		</form>
	</div>

	<div id="tab-settings-privacy" class="contentTabContainer">
		<form action="/settings/privacy/" method="post" class="ajaxFormReload">
			<a id="request_permission" class="icomment icon16 textButton"><span></span>Allow site to send HTML5 web notifications</a>
			<br />
			<hr />

			<label><input type="checkbox" class="checkbox" name="use_ssl" value="1"/> Browse KickassTorrents on a secure connection (https)</label>
			<br />
			<label><input type="checkbox" class="checkbox" name="dont_ask" value="1" onchange="confirm_url(this);"/> Don't ask for confirmation on external links</label>
			<br />
			<label><input type="checkbox" class="checkbox" name="hide_profile" value="1"/> Hide profile info</label>
			<br />
			<label><input type="checkbox" class="checkbox" name="hide_online" value="1"/> Hide online status</label>
			<br />
			<label><input type="checkbox" class="checkbox" name="hide_friending" value="1"/> Do not allow friending</label>
			<br />
			<label><input type="checkbox" class="checkbox" name="hide_wall" value="1"/> Disable user wall</label>
			<br />
			<hr />
			<h3>Blocked users</h3>
			<table class="formtable">
				<tr>	
					<td class="nobr valignTop">Block this username</td>
					<td><input type="text" name="blockuser" value="" class="textinput"/>&nbsp;<button type="submit" name="block" class="siteButton bigButton"><span>block</span></button><br />
					<br />
										<strong>No users blocked</strong><br />
														<small class="lightgrey">These users won't be able to send you private messages<br /> or write on your wall</small>
					 
					</td>
				</tr>
			</table>
			<div class="buttonsline">
				<a href="#" class="siteButton bigButton" onclick="$.fancybox.close();return false;"><span>cancel</span></a>		    <button type="submit" name="submit" class="siteButton bigButton" id="butsave"><span>save</span></button>
			</div>
		</form>
	</div>
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		if (!window.webkitNotifications ) {
			return $("#request_permission").remove();
		} else if (window.webkitNotifications.checkPermission() == 0) {
			return $('#request_permission').addClass('disabledButton');
		};
		$('#request_permission').bind('click.my', function() {
			window.webkitNotifications.requestPermission(function() { } );
			$('#request_permission').addClass('disabledButton');
		});
	});
	</script>
	</div>
</div>

</body>
</html>