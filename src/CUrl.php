<?php

namespace CUrl;

class CUrl {
	private $ch = null;

	public function __construct(string $url = null) {
		$this->ch = curl_init($url);
	}

	public function setopt(int $option, $value): self {
		curl_setopt($this->ch, $option, $value);
		return $this;
	}

	public function setopt_array(array $options): self {
		curl_setopt_array($this->ch, $options);
		return $this;
	}

	public function escape(string $str): string {
		return curl_escape($this->ch, $str);
	}

	public function unescape(string $str): string {
		return curl_unescape($this->ch, $str);
	}

	public function getinfo(int $opt = null) {
		return curl_getinfo($this->ch, $opt);
	}

	public function pause(int $bitmask): int {
		return curl_pause($this->ch, $bitmask);
	}

	public function reset(): void {
		curl_reset($this->ch);
	}

	public function exec() {
		$return = curl_exec($this->ch);
		if (false === $return) {
			throw new CUrlException(curl_error($this->ch), curl_errno($this->ch));
		}
		return $return;
	}

	public function __destruct() {
		curl_close($this->ch);
	}

	public function __clone() {
		$this->ch = curl_copy_handle($this->ch);
	}

	public function getInstance() {
		return $this->ch;
	}
}
