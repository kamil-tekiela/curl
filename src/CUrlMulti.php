<?php

namespace CUrl;

class CUrlMulti {
	private $mh = null;

	public function __construct() {
		$this->mh = curl_multi_init();
	}

	public function setopt(int $option, $value): self {
		curl_setopt($this->mh, $option, $value);
		return $this;
	}

	public function setopt_array(array $options): self {
		foreach ($options as $option => $value) {
			curl_setopt($this->mh, $option, $value);
		}
		return $this;
	}

	public function add_handle(Curl $ch): int {
		return curl_multi_add_handle($this->mh, $ch->getInstance());
	}

	public function remove_handle(CUrl $ch): int {
		return curl_multi_remove_handle($this->mh, $ch->getInstance());
	}

	public function exec(int &$still_running): int {
		return curl_multi_exec($this->mh, $still_running);
	}

	public function multi_getcontent(): string {
		return curl_multi_getcontent($this->mh);
	}

	public function info_read(int &$msgs_in_queue = null): array {
		return curl_multi_info_read($this->mh, $msgs_in_queue);
	}

	public function multi_select(float $timeout = 1.0): int {
		return curl_multi_select($this->mh, $timeout);
	}

	public function run_blocking_loop(callable $callback): void {
		do {
			$status = curl_multi_exec($this->mh, $active);
			if ($active) {
				// Wait a short time for more activity
				curl_multi_select($this->mh);
				$callback();
			}
		} while ($active && $status == CURLM_OK);
		if ($status != CURLM_OK) {
			throw new CUrlException(curl_multi_strerror($status), $status);
		}
	}

	public function __destruct() {
		curl_share_close($this->mh);
	}
}
