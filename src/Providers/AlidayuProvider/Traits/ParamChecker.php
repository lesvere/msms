<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-17
 * Time: 下午1:20
 */

namespace Lesvere\Msms\Providers\AlidayuProvider\Traits;


trait ParamChecker
{
    /**
     * Check the request's parameters.
     *
     * @param  string $path
     * @return void
     */
    public function checkParams($params, $type = 'sms.send')
    {
        $mandatoryParameters = [
            'sms.send'             => [
                'sms_type', 'sms_free_sign_name', 'rec_num', 'sms_template_code',
            ],
            'sms.query'            => [
                'rec_num', 'query_date', 'current_page', 'page_size',
            ],
            'voice.singlecall'     => [
                'called_num', 'called_show_num', 'voice_code',
            ],
            'voice.doublecall'     => [
                'caller_num', 'caller_show_num', 'called_num', 'called_show_num',
            ],
            'tts.singlecall'       => [
                'called_num', 'called_show_num', 'tts_code',
            ],
            'flow.charge'          => [
                'phone_num', 'grade', 'out_recharge_id'
            ],
            'flow.charge.province' => [
                'phone_num', 'grade', 'out_recharge_id'
            ],
        ];
        foreach ($mandatoryParameters[$type] as $value) {
            if (!array_key_exists($value, $params)) {
                throw new MissingMandatoryParametersException("paramter {$value} is required!");
            }
        }
    }
}