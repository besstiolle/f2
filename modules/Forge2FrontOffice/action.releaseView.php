<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}


if(empty($params['all'])){

	/**
	 Get the release
	**/
	$serviceRelease = new ServiceRelease();
	$release = $serviceRelease->getOne($params['releaseId']);
	if($release === FALSE){ return; }
	$release['current'] = true;
	$releases = array($release);
	
	//Prepare the size in human readable way
	for($j=0; $j < count($releases); $j++) {
		for($k=0; $k < count($releases[$j]['files']); $k++) {
			if($releases[$j]['files'][$k]['size'] < 1048576){
				$releases[$j]['files'][$k]['size_human_readable'] = round($releases[$j]['files'][$k]['size'] / 1024).'Ko';
			} else {
				$releases[$j]['files'][$k]['size_human_readable'] = round($releases[$j]['files'][$k]['size'] / 1048576).'Mo';
			}
		}
	}

	/**
	 Check the project
	**/
	$projectId = $release['package_id']['project_id'];
	if($project['id'] !== $projectId){
		$msg = 'The project #%d %s doesn\'t have any release #%d';
		return errorGenerator::display404(sprintf($msg, $projectId, $projectName, $release['id']));
	}

	$smarty->assign('title', $project['name']);
	$smarty->assign('project', $project);
	$smarty->assign('releases', $releases);

	echo $smarty->display('releaseView.tpl');
}else {

	/**
	 Get all releases
	 **/
	$restParameters = array();

	// Number of the page
	$restParameters['p'] = 1;
	if(!empty($params['pagin_page'])) {
		$restParameters['p'] = $params['pagin_page'];
	}

	//Number of element by page
	$restParameters['n'] = 10;
	if(!empty($params['pagin_num'])) {
		$restParameters['n'] = $params['pagin_num'];
	}

	if(!$is_member && !$is_admin){
		$restParameters['is_active'] = true;
	}

	$restParameters['package_id'] = $params['packageId'];

	$serviceRelease = new ServiceRelease();
	//$oldReleases = $serviceRelease->getOlderReleasesByPackageId($release['id'], $release['package_id']['id']);
	$result = $serviceRelease->getAll($restParameters);
	if($result === FALSE){ return; }

	$releases = $result[0];
	//Prepare the size in human readable way
	for($j=0; $j < count($releases); $j++) {
		for($k=0; $k < count($releases[$j]['files']); $k++) {
			if($releases[$j]['files'][$k]['size'] < 1048576){
				$releases[$j]['files'][$k]['size_human_readable'] = round($releases[$j]['files'][$k]['size'] / 1024).'Ko';
			} else {
				$releases[$j]['files'][$k]['size_human_readable'] = round($releases[$j]['files'][$k]['size'] / 1048576).'Mo';
			}
		}
	}

	$page_counter = $result[1];


	$smarty->assign('title', $project['name']);
	$smarty->assign('project', $project);
	$smarty->assign('releases', $releases);

	$page_url = $root_url.'/project/'.$projectId.'/shootbox/package/'.$params['packageId'].'/release/list?';

	//Include paginator
	include('lib/inc.paginator.php');

	echo $smarty->display('releases.tpl');
	
}


include('lib/inc.debug.php');