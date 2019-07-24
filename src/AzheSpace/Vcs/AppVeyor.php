<?php

namespace src\AzheSpace\Vcs;

use src\AzheSpace\Utils\WordUtil;

class AppVeyor
{
	/**
	 * AppVeyor constructor.
	 *
	 * @param $payload
	 */
	public function __construct($payload)
	{
		$this->execute($payload);
	}
	
	/**
	 * @param $payload
	 * @return string
	 */
	private function execute($payload)
	{
		$json = json_encode($payload, true);
		
		$event_name = $json['eventName'];
		switch (true) {
			case WordUtil::isContain($event_name, 'build'):
				$eventData = $json['eventData'];
				$status = $eventData['status'];
				$repoName = $eventData['repositoryName'];
				$buildUrl = $eventData['buildUrl'];
				$text = "Build $status <a href='$buildUrl'>$repoName</a>";
				break;
			
			default:
				$text = "AppVeyor Event not defined. please contact @TgBotId";
				break;
		}
		
		return $text;
	}
	
}
