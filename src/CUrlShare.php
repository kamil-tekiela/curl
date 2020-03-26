<?php

namespace CUrl;

class CUrlShare {
	private $sh = null;

	public function __construct() {
		$this->sh = curl_share_init();
	}

	public function setopt(int $option, $value): self {
		curl_setopt($this->sh, $option, $value);
		return $this;
	}

	public function setopt_array(array $options): self {
		foreach ($options as $option => $value) {
			curl_setopt($this->sh, $option, $value);
		}
		return $this;
	}

	/**
	 * Returns the resource handle to be used in `curl_setopt($ch1, CURLOPT_SHARE, $sh);`
	 * e.g.
	 * ```
	 * $shCUrl = new CUrlShare();
	 * $CUrl = new CUrl();
	 * $CUrl->setopt(CURLOPT_SHARE, $shCurl->getInstance());
	 * ```
	 *
	 * @return void
	 */
	public function getInstance() {
		return $this->sh;
	}

	public function __destruct() {
		curl_share_close($this->sh);
	}
}
