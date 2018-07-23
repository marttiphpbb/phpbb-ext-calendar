<?php
/**
* phpBB Extension - marttiphpbb calendarinput
* @copyright (c) 2014 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\calendarinput\service;

use phpbb\config\db_text as config_text;
use phpbb\cache\driver\driver_interface as cache;
use marttiphpbb\calendarinput\util\cnst;

class store
{
	protected $config_text;
	protected $cache;
	protected $local_cache;
	protected $transaction = false;

	public function __construct(
		config_text $config_text,
		cache $cache
	)
	{
		$this->config_text = $config_text;
		$this->cache = $cache;
	}

	private function get_all():array
	{
		if (isset($this->local_cache) && is_array($this->local_cache))
		{
			return $this->local_cache;
		}

		$settings = $this->cache->get(cnst::CACHE_ID);

		if ($settings)
		{
			$this->local_cache = $settings;
			return $settings;
		}

		$this->local_cache = unserialize($this->config_text->get(cnst::ID));
		$this->cache->put(cnst::CACHE_ID, $this->local_cache);

		return $this->local_cache;
	}

	private function set(array $ary):void
	{
		if ($ary === $this->local_cache)
		{
			return;
		}
		$this->local_cache = $ary;

		if (!$this->transaction)
		{
			$this->write($ary);
		}
	}

	private function write(array $ary):void
	{
		$this->cache->put(cnst::CACHE_ID, $ary);
		$this->config_text->set(cnst::ID, serialize($ary));
	}

	public function transaction_start():void
	{
		$this->transaction = true;
	}

	public function transaction_end():void
	{
		$this->transaction = false;
		$this->write($this->local_cache);
	}

	private function set_string(string $name, string $value):void
	{
		$ary = $this->get_all();
		$ary[$name] = $value;
		$this->set($ary);
	}

	private function get_string(string $name):string
	{
		return $this->get_all()[$name];
	}

	private function set_int(string $name, int $value):void
	{
		$ary = $this->get_all();
		$ary[$name] = $value;
		$this->set($ary);
	}

	private function get_int(string $name):int
	{
		return $this->get_all()[$name];
	}

	private function set_boolean(string $name, bool $value):void
	{
		$ary = $this->get_all();
		$ary[$name] = $value;
		$this->set($ary);
	}

	private function get_boolean(string $name):bool
	{
		return $this->get_all()[$name];
	}

	private function set_forum_boolean(int $forum_id, string $name, bool $bool):void
	{
		$ary = $this->get_all();
		if ($bool)
		{
			$ary['forums'][$forum_id][$name] = true;
		}
		else
		{
			unset($ary['forums'][$forum_id][$name]);
		}
		$this->set($ary);
	}

	private function get_forum_boolean(int $forum_id, string $name):bool
	{
		return $this->get_all()['forums'][$forum_id][$name] ?? false;
	}

	public function get_lower_limit_days():int
	{
		return $this->get_int('lower_limit_days');
	}

	public function set_lower_limit_days(int $days):void
	{
		$this->set_int('lower_limit_days', $days);
	}

	public function get_upper_limit_days():int
	{
		return $this->get_int('upper_limit_days');
	}

	public function set_upper_limit_days(int $days):void
	{
		$this->set_int('upper_limit_days', $days);
	}

	public function get_min_duration_days():int
	{
		return $this->get_int('min_duration_days');
	}

	public function set_min_duration_days(int $days):void
	{
		$this->set_int('min_duration_days', $days);
	}

	public function get_max_duration_days():int
	{
		return $this->get_int('max_duration_days');
	}

	public function set_max_duration_days(int $days):void
	{
		$this->set_int('max_duration_days', $days);
	}

	public function get_required(int $forum_id):bool
	{
		return $this->get_forum_boolean($forum_id, 'required');
	}

	public function set_required(int $forum_id, bool $required):void
	{
		$this->set_forum_boolean($forum_id, 'required', $required);
	}

	public function get_enabled(int $forum_id):bool
	{
		return $this->get_forum_boolean($forum_id, 'enabled');
	}

	public function set_enabled(int $forum_id, bool $enabled):void
	{
		$this->set_forum_boolean($forum_id, 'enabled', $enabled);
	}

	public function get_placement_before():bool
	{
		return $this->get_boolean('placement_before');
	}

	public function set_placement_before(bool $value):void
	{
		$this->set_boolean('placement_before', $value);
	}

	public function get_visualization_date_format():string
	{
		return $this->get_string('visualization_date_format');
	}

	public function set_visualization_date_format(string $format):void
	{
		$this->set_string('visualization_date_format', $format);
	}
}
