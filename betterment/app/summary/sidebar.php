 <?php
 //Get file name
 //so as to know which file is active
      $currentFile = $_SERVER["SCRIPT_NAME"];
	  //extract it from forward /
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1]; 
	  
	  $qry = mysqli_query($mysqli,"SELECT * FROM users where id='".$_SESSION['id']."' ");
	   
    $rows = mysqli_fetch_assoc($qry);
 
 ?>
 

 <div class="SidebarLayout-sidebar">
            <div class="Navigation " data-controller="navigation">
                <div class="Navigation-collapsedHeader">
                    <div class="Navigation-hamburger" data-action="click->navigation#open">
                        <span class="sc-Icon sc-Icon--s sc-Icon--white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">

                                <path d="M0 9V7h16v2H0zm0-4V3h16v2H0zm0 8v-2h16v2H0z" />
                            </svg>
                        </span>

                    </div>

                    <a href="index">
                        <span class="sc-Logo sc-Logo--retail sc-Logo--knockout">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 63" aria-label="Betterment"
                                role="img">
                                <title>Betterment</title>
                                <path
                                    d="M449.7 44.7c0 11.6 6.1 18 17.7 18 5 0 9-1 12.5-2.7l-3.5-11a13 13 0 0 1-6.1 1.6c-4.4 0-6.6-2.6-6.6-7.4V27.3h13.7V16.1h-13.8V.4L449.7 5v39.7z" />
                                <path
                                    d="M358 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8 2.6 9.3 7.4H358zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5h-13.5c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z" />
                                <path
                                    d="M428.6 61.3h13.8V33.5c0-5.6-1.7-10.3-4.8-13.7a16.2 16.2 0 0 0-12.4-5.1 19 19 0 0 0-14.1 6V16h-14v45.3h14v-21c0-8.3 3.4-12.8 9.5-12.8 4.8 0 8 3.6 8 9v24.8z" />
                                <path
                                    d="M324.2 61.3H338V34c0-11.8-6.8-19.2-16.9-19.2-6.7 0-12.2 2.7-16 7.8-3-5-8.1-7.8-14.5-7.8-5.6 0-10 1.9-13.3 5.7V16h-14v45.3h14V39.1c0-7.4 3-11.6 8.6-11.6 5.2 0 7.8 3 7.8 8.5v25.3h14V39.1c0-7.4 3.2-11.6 9-11.6 4.5 0 7.5 3.7 7.5 8.8v25z" />
                                <path
                                    d="M225.6 61.3h13.9V47c0-12.6 5.7-17.7 14.8-17.7 2.3 0 3.8.3 3.8.3V15.8c-1-.3-1.9-.4-3.2-.4-6.7 0-11.7 3.3-15.4 9.7v-9h-14v45.2z" />
                                <path
                                    d="M186.4 33.6a10 10 0 0 1 9.8-7.4c4.6 0 8.1 2.6 9.3 7.4h-19.1zm33.2 5c-.3-14-10-24-23.4-24-13.7 0-24 10.4-24 24 0 13 9.5 24 24 24 10.3 0 19.8-6.5 22.5-15.5h-13.5c-2 2.8-5 4.2-9 4.2-5 0-9-3.4-10-9h33.4v-3.6z" />
                                <path
                                    d="M121.3 27.3h19.4v17.4c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7l-3.6-11a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3h13.7V16.1h-13.7V.4L140.7 5v11h-19.4V.6L107.4 5v39.7c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7L134 49a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3z" />
                                <path
                                    d="M68.5 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8.1 2.6 9.3 7.4H68.5zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5H87.3c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z" />
                                <path
                                    d="M28.3 49.5H14V37.3h14.3c3.3 0 6.6 2.1 6.6 6.2 0 3.5-2.7 6-6.6 6zM14 13.6h12.5c4.6 0 6.6 3 6.6 6 0 4.3-3.4 6.3-6.6 6.3H14V13.6zM40.7 30S48 26.2 48 17c0-7.2-6.3-15.3-18.8-15.3H0v59.7h29.2c16 0 20.4-10 20.4-16.8 0-10.9-8.9-14.6-8.9-14.6z" />
                            </svg>
                        </span>

                    </a>

                    <div class="DropdownInput DropdownInput--actionMenu DropdownInput--down DropdownInput--right"
                        data-behavior="action-menu">
                        <div class="Navigation-transferButton" data-behavior="action-menu-click-target">
                            <span class="sc-Icon sc-Icon--s sc-Icon--white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">

                                    <path
                                        d="M11.7 0l-1.4 1.4 1.9 2H0v2h12.2l-2 1.9 1.5 1.4L16 4.3 11.7 0zM0 11.7L4.3 16l1.4-1.4-1.9-2H16v-2H3.8l2-1.9-1.5-1.4L0 11.7z" />
                                </svg>
                            </span>

                        </div>
                        <div class="DropdownInput-options" tabindex="0">
                            <ul tabindex="0">
                                <li><a data-track-module="HeaderNav" data-track-name="Deposit"
                                        data-track-event="ElementClicked" href="deposit_flows/new.html">Deposit</a></li>
                                <li><a data-track-module="HeaderNav" data-track-name="Rollover"
                                        data-track-event="ElementClicked" href="rollovers/new.html">Start
                                        a rollover</a></li>
                                <li><a data-track-module="HeaderNav" data-track-name="Withdraw"
                                        data-track-event="ElementClicked"
                                        href="withdrawal_sub_account_selections/new.html">Withdraw</a></li>
                                <hr class="sc-m--0">
                                <li><a data-track-module="HeaderNav" data-track-name="ManageTransfers"
                                        data-track-event="ElementClicked" href="transfer.html">Manage transfers</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="Navigation-overlay" data-action="click->navigation#clickAway"></div>

                <div class="Navigation-sidebar">
                    <div class="Navigation-sidebarHeader ft-sidebarHeader">
                        <a href="index">
                            <span class="sc-Logo sc-Logo--retail sc-Logo--knockout Navigation-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 63" aria-label="Betterment"
                                    role="img">
                                    <title>Betterment</title>
                                    <path
                                        d="M449.7 44.7c0 11.6 6.1 18 17.7 18 5 0 9-1 12.5-2.7l-3.5-11a13 13 0 0 1-6.1 1.6c-4.4 0-6.6-2.6-6.6-7.4V27.3h13.7V16.1h-13.8V.4L449.7 5v39.7z" />
                                    <path
                                        d="M358 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8 2.6 9.3 7.4H358zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5h-13.5c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z" />
                                    <path
                                        d="M428.6 61.3h13.8V33.5c0-5.6-1.7-10.3-4.8-13.7a16.2 16.2 0 0 0-12.4-5.1 19 19 0 0 0-14.1 6V16h-14v45.3h14v-21c0-8.3 3.4-12.8 9.5-12.8 4.8 0 8 3.6 8 9v24.8z" />
                                    <path
                                        d="M324.2 61.3H338V34c0-11.8-6.8-19.2-16.9-19.2-6.7 0-12.2 2.7-16 7.8-3-5-8.1-7.8-14.5-7.8-5.6 0-10 1.9-13.3 5.7V16h-14v45.3h14V39.1c0-7.4 3-11.6 8.6-11.6 5.2 0 7.8 3 7.8 8.5v25.3h14V39.1c0-7.4 3.2-11.6 9-11.6 4.5 0 7.5 3.7 7.5 8.8v25z" />
                                    <path
                                        d="M225.6 61.3h13.9V47c0-12.6 5.7-17.7 14.8-17.7 2.3 0 3.8.3 3.8.3V15.8c-1-.3-1.9-.4-3.2-.4-6.7 0-11.7 3.3-15.4 9.7v-9h-14v45.2z" />
                                    <path
                                        d="M186.4 33.6a10 10 0 0 1 9.8-7.4c4.6 0 8.1 2.6 9.3 7.4h-19.1zm33.2 5c-.3-14-10-24-23.4-24-13.7 0-24 10.4-24 24 0 13 9.5 24 24 24 10.3 0 19.8-6.5 22.5-15.5h-13.5c-2 2.8-5 4.2-9 4.2-5 0-9-3.4-10-9h33.4v-3.6z" />
                                    <path
                                        d="M121.3 27.3h19.4v17.4c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7l-3.6-11a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3h13.7V16.1h-13.7V.4L140.7 5v11h-19.4V.6L107.4 5v39.7c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7L134 49a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3z" />
                                    <path
                                        d="M68.5 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8.1 2.6 9.3 7.4H68.5zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5H87.3c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z" />
                                    <path
                                        d="M28.3 49.5H14V37.3h14.3c3.3 0 6.6 2.1 6.6 6.2 0 3.5-2.7 6-6.6 6zM14 13.6h12.5c4.6 0 6.6 3 6.6 6 0 4.3-3.4 6.3-6.6 6.3H14V13.6zM40.7 30S48 26.2 48 17c0-7.2-6.3-15.3-18.8-15.3H0v59.7h29.2c16 0 20.4-10 20.4-16.8 0-10.9-8.9-14.6-8.9-14.6z" />
                                </svg>
                            </span>

                        </a>
                        <div class="Navigation-closeClickTarget" data-action="click->navigation#close"></div>
                        <span class="Navigation-closeButton">
                            <span class="sc-Icon sc-Icon--s sc-Icon--white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">

                                    <polygon
                                        points="14.587 .001 8 6.588 1.413 .001 0 1.414 6.587 8.001 0 14.588 1.413 16 8 9.414 14.587 16 16 14.588 9.413 8.001 16 1.414" />
                                </svg>
                            </span>

                        </span>
                        <h3 class="Navigation-welcomeMessage sc-m-l--m u-knockout ft-sidebarWelcomeMessage">Hi, <?php echo $rows['name']; ?>
                        </h3>
                    </div>


                    <div class="Navigation-linkContainer ft-sidebarGoalsContainer">
                        <a class="Navigation-link <?php if($currentFile=='index.php'){
                            echo 'is-active';
                        } ?>  ft-sidebarSummaryLink" href="index">
                            <div class="Navigation-icon">
                                <span class="sc-Icon sc-Icon--s sc-Icon--grey">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">

                                        <path d="M8 0L0 6v10h7v-6h2v6h7V6L8 0zM2 7l6-4.5L14 7v7h-3V8H5v6H2V7z" />
                                    </svg>
                                </span>

                            </div>
                            <span>Home</span>
                        </a>



                        <a class="Navigation-link <?php if($currentFile=='retirement.php'){
                            echo 'is-active';
                        } ?> ft-sidebarGoalLink" href="retirement">
                            <div class="Navigation-icon Navigation-icon--goal">
                                <span class="GoalIcon  GoalIcon--s">
                                    <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <g transform="translate(4 4)" fill="none" fill-rule="evenodd">
                                            <circle fill="#A2DCFF" cx="20" cy="20" r="20" />
                                            <path
                                                d="M.4359 15.8275C2.355 6.7846 10.3852 0 20 0s17.645 6.7846 19.5641 15.8275C34.6935 17.6343 27.731 18.7652 20 18.7652c-7.731 0-14.6935-1.1309-19.5641-2.9377z"
                                                fill="#FFF" />
                                            <path
                                                d="M17.7594.125c-3.2746 4.234-5.5298 10.7441-6.0028 18.1953-4.381-.4889-8.2646-1.357-11.3233-2.4916C2.2015 7.4974 9.1568 1.083 17.7594.125zM22.2417.125c3.2744 4.2338 5.5295 10.7434 6.0024 18.1941 4.3807-.4888 8.264-1.3568 11.3226-2.4914C37.7987 7.497 30.8438 1.0828 22.2417.125z"
                                                fill="#2179EE" />
                                            <path
                                                d="M18.75 39.9616V18.7553a78.822 78.822 0 0 0 2.5 0v21.2063a20.307 20.307 0 0 1-2.5 0z"
                                                fill="#1F4AA9" />
                                        </g>
                                    </svg>
                                </span>

                            </div>
                            <span title="Retirement">Retirement</span>
                        </a>



                        <a class="Navigation-link <?php if($currentFile=='holding.php'){
                            echo 'is-active';
                        } ?> ft-sidebarGoalLink" href="holding">
                            <div class="Navigation-icon Navigation-icon--goal">
                                <span class="GoalIcon  GoalIcon--s">
                                    <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <g transform="translate(4 4)" fill="none" fill-rule="evenodd">
                                            <circle fill="#4E23AB" cx="20" cy="20" r="20" />
                                            <path
                                                d="M26.0197 39.0782C24.1199 39.6771 22.0977 40 20 40c-2.2826 0-4.4758-.3824-6.5192-1.0866L10.9995 28.608c-.7855-.3377-1.163-.597-1.163-.597-.361-.1917-.681-.394-.9576-.607-.7305-.5612-1.1411-1.1906-1.14-1.8506l.0118-5.9294c-.004 2.0185 3.8041 3.7228 8.9696 4.2224l6.137.0116c5.1658-.48 8.9789-2.17 8.9828-4.1881l-.0117 5.9294c-.0012.66-.4142 1.287-1.1471 1.8459-.2753.2117-.5953.4129-.9588.6035 0 0-.3691.272-1.1694.62l-2.5334 10.4096z"
                                                fill="#9B73FF" />
                                            <path
                                                d="M20.901 18.4074v-2.6529c1.8712.0637 3.6198.282 5.146.6202.3305.0718.6517.1518.9611.2353 2.9353.7988 4.833 2.0682 4.8306 3.4941-.0047 2.4012-5.4012 4.3365-12.0518 4.3247-6.6517-.013-12.0411-1.9694-12.0376-4.3706.0046-2.2994 4.9493-4.1711 11.2075-4.3156v2.6423c-4.052.0924-6.9516.8906-8.557 1.678 1.693.8389 4.8307 1.6953 9.3071 1.7236.0295 0 .0553.0011.0847.0011 4.4942.0071 7.6824-.8482 9.3977-1.6894-1.5301-.7569-4.1956-1.517-8.2884-1.6908z"
                                                fill="#D3BCFF" />
                                            <path
                                                d="M20.901 21.7716a34.1412 34.1412 0 0 1-1.1094.016c-.0294 0-.0552-.0011-.0847-.0011a35.138 35.138 0 0 1-.7501-.0127v-8.2731c-.6085.2512-3.0574 1.1386-5.0603.1487-2.2553-1.1144-2.9664-4.1384-2.9963-4.2675l-.0669-.2962.2766-.1256c.1187-.0553 2.9537-1.3264 5.2101-.212 1.421.703 2.2277 2.1608 2.6368 3.1772V8.672c-.6903-.8228-1.7286-2.3486-1.6226-4.0796.1533-2.5123 2.6655-4.34 2.7716-4.4172L20.3524 0l.2247.204c.0968.0887 2.3671 2.2092 2.215 4.7203-.0957 1.572-1.1156 2.8753-1.8912 3.6498v3.803c.3342-.9784 1.1548-2.8131 2.8062-3.629 2.2553-1.1144 5.0903.1567 5.2101.212l.2755.1256-.0669.2962c-.03.129-.741 3.153-2.9963 4.2675-2.2564 1.1144-5.0903-.1556-5.2286-.2202v8.3424z"
                                                fill="#FFF" />
                                        </g>
                                    </svg>
                                </span>

                            </div>
                            <span title="Build wealth 2">Build wealth</span>
                        </a>




                        <a class="Navigation-link <?php if($currentFile=='safey-net.php'){
                            echo 'is-active';
                        } ?> ft-sidebarGoalLink" href="safey-net">
                            <div class="Navigation-icon Navigation-icon--goal">
                                <span class="GoalIcon  GoalIcon--s">
                                    <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <g fill="none" fill-rule="evenodd">
                                            <path
                                                d="M24 44C12.9543 44 4 35.0457 4 24S12.9543 4 24 4s20 8.9543 20 20-8.9543 20-20 20zm0-10c5.5228 0 10-4.4772 10-10s-4.4772-10-10-10-10 4.4772-10 10 4.4772 10 10 10z"
                                                fill="#61B1FF" />
                                            <path
                                                d="M14.7385 27.7785c1.0945 2.68 3.3184 4.7787 6.0802 5.7048l-7.4562 7.4563a20.1071 20.1071 0 0 1-5.9794-5.8058l7.3554-7.3553zm-.2218-6.9598l-7.4563-7.4562a20.1071 20.1071 0 0 1 5.8058-5.9794l7.3553 7.3554c-2.68 1.0945-4.7787 3.3184-5.7048 6.0802zm13.2618-6.0802l7.3553-7.3554a20.1071 20.1071 0 0 1 5.8058 5.9794l-7.4563 7.4562c-.926-2.7618-3.0249-4.9857-5.7048-6.0802zm5.483 13.04l7.3554 7.3553a20.1071 20.1071 0 0 1-5.9794 5.8058l-7.4562-7.4563c2.7618-.926 4.9857-3.0249 6.0802-5.7048z"
                                                fill="#1F4AA9" />
                                        </g>
                                    </svg>
                                </span>

                            </div>
                            <span title="Safety Net">Safety Net(Trust)</span>
                        </a>




                        <a class="Navigation-link ft-sidebarAddNewAccount" href="add_goal/by_goal_type.html">
                            <div class="Navigation-icon">
                                <span class="sc-Icon sc-Icon--s sc-Icon--grey">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">

                                        <polygon points="7 0 7 7 0 7 0 9 7 9 7 16 9 16 9 9 16 9 16 7 9 7 9 0" />
                                    </svg>
                                </span>

                            </div>
                            <span>Add new</span>
                        </a> </div>

                    <div class="ft-sidebarSecondaryLinksContainer">

                        <a target="_blank" class="Navigation-link ft-sidebarAdvisor" data-track-module="MainMenu"
                            data-track-name="AdvicePackages" data-track-event="ElementClicked"
                            href="https://www.betterment.com/advice-packages/?utm_source=webapp">Ask
                            an Advisor</a>


                        <a class="Navigation-link  ft-sidebarSettings" data-track-module="MainMenu"
                            data-track-name="Settings" data-track-event="ElementClicked"
                            href="settings.html">Settings</a>

                        <a class="Navigation-link Navigation-logoutAction ft-sidebarLogout" data-track-module="MainMenu"
                            data-track-name="Logout" data-track-event="ElementClicked"
                            data-disable-with="Logging out..." form="{:data=&gt;{:disable_no_spinner=&gt;true}}"
                            rel="nofollow" data-method="delete" href="logout">Log out</a>

                    </div>
                </div>

            </div>


        </div>