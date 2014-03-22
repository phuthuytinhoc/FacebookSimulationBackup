<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$nguoixoa = $_SESSION['user'];
	$ban =  $_GET['email'];

	$query = 'DELETE FROM friend WHERE (fromUser = \''.$nguoixoa.'\' AND toUser = \''.$ban.'\' )
									OR (toUser = \''.$nguoixoa.'\' AND fromUser = \''.$ban.'\' )';
	mysql_query($query);


 echo '<table>';
            		
				$s = 'SELECT * FROM profile WHERE
						 email IN (SELECT toUser FROM friend WHERE fromUser =  \''.$_SESSION['user'].'\' AND statusFriend = 2 ) OR 
						 email IN (SELECT fromUser FROM friend WHERE toUser =  \''.$_SESSION['user'].'\' AND statusFriend =  2)';
				$kq = @mysql_query($s, $conn);
				$count=0;
				echo '<tr>';
				while ($dong = mysql_fetch_array($kq))
				{
					echo '           	
                    <td>
                    	<div class="box-friend" >
                            <table>
                                <tr>
                                    <td><img src="ShowFriends/IMG/avatar.jpg" height="75px" width="75px"  /></td>
                                    <td width="221px">
                                        <div class="user-friend">
                                            <span><a class="link-friend user-f" href="userpage.php?user='.$dong[0].'" >'.$dong['lastname'].' '.$dong['firstname'].'</a></span>
                                            <span><a class="link-friend banchung-f">Số bạn chung</a></span>
                                        </div>
                                    </td> 
                                    <td><h3><div id="';echo '#'.str_replace(array('@','.'),'',$dong[0]); ;echo '" class="buttonBanBe">Bạn bè</div></h3></td>   
									<div id="';echo str_replace(array('@','.'),'',$dong[0]);echo '" style="display:none; ">
                                    	<span>Xóa người bạn này khỏi danh sách bạn bè 
											<a class="link-friend user-f" href="userpage.php?user='.$dong[0].'">
										 	'.$dong['lastname'].' '.$dong['firstname'].' 
										 	</a>
										</span>
										<span>
											<label class="buttonPost"><input type="button" name="'.$dong[0].'" value="Xóa" class="btnPost"></label>
											<span class="Cancel"><label class="';echo str_replace(array('@','.'),'',$dong[0]);echo '">Hủy</</span>
										</span><br>
                                    </div>
                                </tr>
                            </table>  
                        </div>
                     </td>   ';
					$count++;
					 if($count!=0 and $count %2!=1)
					 {
						 echo '</tr>';
						 echo '<tr>';
					 }	
				} 
				
               echo' </tr>';

            echo'</table>'; 
			
			
			?>