<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);


class AwzEuropostBaloon extends CBitrixComponent
{
	/**
	 * Execute component.
	 *
	 * @return void
	 */
	public function executeComponent()
	{
        if (!Loader::includeModule('awz.europost'))
        {
            return;
        }
        $paramsIn =& $this->getParams();

        $this->arResult['ITEM'] = array();

        if($paramsIn['DATA']){
            $this->arResult['ITEM'] = $paramsIn['DATA'];
        }elseif($paramsIn['ID']){
            $r = \Awz\Europost\PvzTable::getPvz($paramsIn['ID']);
            if($r)
                $this->arResult['ITEM'] = $r['PRM'];
        }

		$this->includeComponentTemplate();
	}

	public function getParams(){
	    return $this->arParams;
    }
}